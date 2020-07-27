<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Cart;

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
        //Tìm order của user hiện tại
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
        //tìm order trong giỏ hàng hiện tại
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
    public function delete(Request $request) {
        $order_id=$request->order_id;
        $product_id=$request->product_id; 
        //Tìm order trong giỏ hàng hiện tại
        $p = order_product::withTrashed()->where
        ([
            'order_id'=>$order_id,
            'product_id'=>$product_id
             
        ])->first();
        //Trừ đi tổng giá đơn hàng order vừa xóa nếu order đó chưa hết hàng
        if(!$p->trashed())
        {
           $c=Order::find($order_id);
           $c->total=$c->total-$p->amount;
           $c->save();
        }
        //Xóa order trong giỏ hàng hiện tại
        order_product::withTrashed()->where
        ([
            'order_id'=>$order_id,
            'product_id'=>$product_id
        ])->forceDelete();
    }
    public function addCart(Request $request){
       
      
        $id=$request->order_id;
        $user= $request->session()->get('key');
        $user_id=$user->id;
       //Kiểm tra xem user_id có tồn tại trong database giỏ hàng
        $carts=Order::where(['user_id'=>$user_id,'status'=>'0'])->first();
        //nếu không tìm được giỏ hàng chứa id đó thì tạo order mới
            
        if(empty($user_id))
        {
            return redirect()->action('loginController@index');
        }
         
        elseif(empty($carts))
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