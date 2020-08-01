<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Cart;
use Illuminate\Support\Facades\DB;
use App\order_product;
use App\Order;
use App\cart_product;
use App\Events\Qty;
use App\Product;
use Carbon\Traits\Cast;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Break_;
use PhpParser\Node\Stmt\Else_;
use SebastianBergmann\Environment\Console;

class UserCartcontroller extends Controller
{
    public function index( Request $request){
        
        $value=$request->session()->get('key');
        return view('admin.index')->with('id',$value);
    }
    public function order(Request $request)
    { 
        $user_id= $request->session()->get('key');
        //Tìm order đang đặt của user hiện tại
        $carts=Order::where(['user_id'=>$user_id->id,'status'=>'0'])->first();
        //chuyển trạng thái sang đã đặt hàng
        $carts->status="1";
        $carts->save();
        //xóa  order đã hết hàng trong đơn hàng
        order_product::withTrashed()->where(
        [
            'order_id'=>$carts->id,
        ])->whereNotNull('deleted_at')->
        forceDelete();
        return redirect()->action('homeController@index');
    }
    public function getUpdateCart(Request $request) 
    {
     
        $a=$request->order_id;
        $b=$request->product_id;
        $c=$request->qty;
        $product=Product::find($b);
        //tìm order trong giỏ hàng hiện tại
       if($request->session()->get('cart'))
        {
            $cart=new Cart(session()->get('cart'));
            $cart->update1($product,$c);
            $request->session()->put('cart',$cart);
        }
        
        else
        { 
           if($a==""  || $b=="" ||$c=="")
                return abort('404');
        order_product::where
        ([
            'order_id'=>$a,
            'product_id'=>$b
        ])->update(['qty' => $c,'amount'=>Product::find($b)->price*$c]);
        //Update lại tổng giá của đơn hàng đó
        $c=Order::find($a);
        $c->total=order_product::where
        ([
            'order_id'=>$a
            
        ])->sum('amount');
        $c->save();
       }
    }
    public function delete(Request $request) {
     
       
        $product_id=$request->product_id; 
        $order_id=$request->order_id;
        $product=Product::withTrashed()->find($product_id);
        if($request->session()->get('cart'))
        {
            $cart=new Cart(session()->get('cart'));
            $cart->delete1($product);
            $request->session()->put('cart',$cart);
            //Nếu user đã xóa hết sản phẩm trong giỏ hàng thì hủy session cart
            if(empty($cart->items))
            $request->session()->forget('cart');
        }
        else
        {
        //Tìm order trong giỏ hàng hiện tại
            if($order_id==""  || $product_id=="")
                return abort('404');
            $p = order_product::withTrashed()->where
            ([
                'order_id'=>$order_id,
                'product_id'=>$product_id
             
            ])->first();
        //Trừ đi tổng giá đơn hàng order vừa xóa nếu order đó chưa hết hàng
            if(!($p->trashed()))
            {   
                $c=Order::find($order_id);
                $c->total=$c->total-$p->amount;
                $c->save();
            }
             
             //Xóa order trong giỏ hàng hiện tại
             order_product::where
             ([
                'order_id'=>$order_id,
                'product_id'=>$product_id
             ])->forceDelete();
        }
       
    }
    public function addCart(Request $request){
       
       
        $id=$request->product_id;
        
        $product=Product::find($id);
      
        $user= $request->session()->get('key');
     
       if(empty($user))
        {
          if($request->session()->get('cart'))
           {
               $cart=new Cart(session()->get('cart'));
           }
          else
           {
               
            $cart=new Cart();
           }
         
            $cart->add($product);
          
            $request->session()->put('cart',$cart);
             //dd($cart);
         // session()->forget('cart');
           
       
           return redirect()->action('homeController123@cart');
        }
        else
        {
        $user_id=$user->id;
        if($id=="")
            return abort('404');
       //Kiểm tra xem user_id có tồn tại trong database giỏ hàng
        $carts=Order::where(['user_id'=>$user_id,'status'=>'0'])->first();
        //nếu không tìm được giỏ hàng chứa id đó thì tạo order mới
            
      
         
        if(empty($carts))
        {
            $carts=new Order();
            $carts->user_id=$user_id;
            $carts->total=Product::find($id)->price;
            $carts->status="0";
            $carts->date=Carbon::now();
            $carts->save();
        }
    
        else
        {
            //add giả sản phẩm vào tổng
            $carts->total=$carts->total+=Product::find($id)->price;
            $carts->save();
        }
        //kiem tra san pham vua them da nam trong cart chua
         $order_product=order_product::where([
            'order_id'=>$carts->id,
            'product_id'=>$id
            
        ])->first();
      
        if(empty($order_product))
        {
            $order_product=new order_product();
            $order_product->order_id=$carts->id;
            $order_product->product_id=$id;
            $order_product->price=Product::find($id)->price;
            $order_product->qty=1;
            $order_product->amount=$order_product->price;
            $order_product->save();
        }
        //neu da co san pham thi tagn qty len 1
            else
            {  
                $order_product::where
                ([
                'order_id'=>$carts->id,
                'product_id'=>$id
                ])->update(['qty'=> $order_product->qty+1,'amount'=>Product::find($id)->price*($order_product->qty+1)]);
           
                 $order_product->save();
            }
                return Redirect::back();
        }
    }
    
 
}