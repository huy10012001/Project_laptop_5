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
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
class UserCartcontroller extends Controller
{
    public function index( Request $request){
        
        $value=$request->session()->get('key');
        return view('admin.index')->with('id',$value);
    }
    public function checkout(Request $request)
    { 
        return view('checkout');
    }
    public function getOrder(Request $request)
    { 
        //Nếu user thay đổi giỏ hàng thì return status ở json
        if($request->session()->has('change'))
        {
            return Response::json(array(
                'status'=>'change',
              
               )); 
        }
        
        else
        {
            $name=$request->name;
            $phone=$request->phone;
            $add=$request->address;
            if($name==null || $phone==null||$add==null)
            {
            return abort('404');
             }
            $user_id= $request->session()->get('key');
            //Tìm order đang đặt của user hiện tại
            $orders=Order::where(['user_id'=>$user_id->id,'status'=>'0'])->first();
            //chuyển trạng thái sang đã đặt hàng
            $orders->name=$name;
            $orders->address=$add;
            $orders->phone=$phone;
            $orders->status="1";
            $orders->date=Carbon::now();
            $orders->save();
            //xóa   order_product đã hết hàng trong giỏ hàng
            order_product::withTrashed()->where(
            [
            'order_id'=>$orders->id,
            ])->whereNotNull('deleted_at')->
            forceDelete();
        }
        
    }
    /*   public function getUpdateCart(Request $request) 
    {
        $request->session()->put('change','update');
        $order_id=$request->order_id;
        $product_id=$request->product_id;
        $c=$request->qty;
        
        if($product_id=="" )
                return abort('404');
        //Khi hủy session cart và chưa đăng nhập
        if(empty($order_id) && !$request->session()->has('cart'))
            {
                 return Response::json(array(
                     'status'=>'no',
                   
            )); 
        }
        if($c>10 ||$c<0 ||empty($c))
        $request->session()->put('qty','qty phải từ 0 tới 10 và không được trống');
        else
        {
            $product=Product::find($product_id);
        //tìm order trong giỏ hàng hiện tại
            if($request->session()->get('cart'))
            {
                $cart=new Cart(session()->get('cart'));
                 //nếu item không tồn tại
                if(!isset($cart->items[$product_id]))
                return Response::json(array(
                'status'=>'no',
           
            )); 
            //Khi còn session cart nhưng user vẫn đăng nhập ở tab khác
                if(!empty($a))
                {
                return Response::json(array(
                 'status'=>'no',
               
                )); 
                }
                $cart->update1($product,$c);
                $request->session()->put('cart',$cart);
           
            }
        
            else
            { 
               
                  
                 $p = order_product::where
                ([
                'order_id'=>$order_id,
                'product_id'=>$product_id
             
                ])->first();
             //Khi trống sản phẩm hoặc đăng nhập với id khác
                $user=Order::find($order_id)->user_id;
                if($request->session()->has('key'))
                {
                   
                    $a=$request->session()->get('key')->id;
                    //Nếu order mới cập nhập
                  
                }
                else
                {
                        $a=null; 
                         if(empty($p)||$a!=$user )
                         return Response::json(array(
                'status'=>'no',
           
                 ));
                } 
       
                order_product::where
                ([
                 'order_id'=>$order_id,
                'product_id'=>$product_id
                ])->update(['qty' => $c,'amount'=>Product::find($product_id)->price*$c]);
                //Update lại tổng giá của đơn hàng đó
                $c=Order::find($order_id);
                $c->total=order_product::where
                ([
                    'order_id'=>$order_id
            
                ])->sum('amount');
                 $c->save();
                 
               
            }
        }
    }*/
    public function getUpdateCart(Request $request) 
    {
        $request->session()->put('change','update');
        $order_id=$request->order_id;
        $product_id=$request->product_id;
        $c=$request->qty;
        if(($c>10 ||$c<0 ||empty($c)) )
        { 
            return Response::json(array(
            'soluong'=>'1',
        )); 
        }
        if($product_id=="" )
                return abort('404');
        //Khi vừa đăng nhập ở tab khác hoặc cart trống và chưa đăng nhập
        /* if(empty($order_id) && !$request->session()->has('cart'))
        {
            
                 return Response::json(array(
                     'status'=>'no',
           )); 
        }*/
        //khi giỏ hàng trống và user chưa đăng nhập hoặc khi vừa đ8ang nhập tab khác
        if(empty($order_id) && !$request->session()->has('cart'))
        {
            
                 return Response::json(array(
                     'status'=>'no',
           )); 
        }
        //đăng xuất bên tab khác và tab hiện tại vẫn mở 
        if(!empty($order_id) && !$request->session()->has('key'))
            {
                 return Response::json(array(
                     'status'=>'no',
                     
           )); 
        }
       
  
        $product=Product::find($product_id);
             //tìm order trong giỏ hàng hiện tại
        if($request->session()->get('cart'))
        {
            
             $cart=new Cart(session()->get('cart'));
                 //nếu item không tồn tại
            if(!isset($cart->items[$product_id]))
            return Response::json(array(
                'status'=>'no',
           
            )); 
               
            $cart->update1($product,$c);
            $request->session()->put('cart',$cart);
           
        }
        
        if($request->session()->has('key'))
        { 
            
            $a=  $request->session()->get('key')->id;
            //Lấy id order mới hoặc id order của user khác
            $new_order=Order::where(['user_id'=>$a,'status'=>'0'])->first();
            //Nếu order mới cập nhập hoặc user khác đăng nhập
            if($order_id!=$new_order->id && !empty($order_id))
            return Response::json(array(
            'status'=>'no' ));
            //Khi sản phẩm cũ bị trống
            if(empty($order_id))
            {
                $order_id=Order::where(['user_id'=>$a])->first()->id;
            }
            $p = order_product::where
            ([
                'order_id'=>$order_id,
                'product_id'=>$product_id
            ])->first();
            //Khi trống sản phẩm 
            if(empty($p))
                return Response::json(array(
                'status'=>'no',
            ));
            //update order_product
             order_product::where
             ([
            'order_id'=>$order_id,
            'product_id'=>$product_id
             ])->update(['qty' => $c,'amount'=>Product::find($product_id)->price*$c]);
            //Update lại tổng giá của đơn hàng đó
            $c=Order::find($order_id);
            $c->total=order_product::where
            ([
            'order_id'=>$order_id
            
             ])->sum('amount');
             $c->save();
        }
    }
    
    public function delete(Request $request) {
        
        $request->session()->put('change','update');
        $product_id=$request->product_id; 
        $order_id=$request->order_id;
       
        if( $product_id=="")
            return abort('404');
      
        $product=Product::withTrashed()->find($product_id);
         //Khi vừa đăng nhập ở tab khác hoặc cart trống và chưa đăng nhập
        if(empty($order_id) && !$request->session()->has('cart'))
        {
         return Response::json(array(
             'status'=>'no',
           
            )); 
        }
        //khi đăng xuất ở tab khác và tab hiện tại chưa đăng xuất
        if(!empty($order_id) && !$request->session()->has('key'))
        {
             return Response::json(array(
                 'status'=>'no',
        )); 
         }
        if($request->session()->has('cart'))
        {
            $cart=new Cart(session()->get('cart'));
            //nếu item không tồn tại
            if(!isset($cart->items[$product_id]))
                return Response::json(array(
                'status'=>'no',
              
               )); 
            
            
            $cart->delete1($product);
            $request->session()->put('cart',$cart);
            
            //Nếu user đã xóa hết sản phẩm trong giỏ hàng thì hủy session cart
            if(empty($cart->items))
            $request->session()->forget('cart');
            return Response::json(array(
                'total'=>$cart->totalPrice,
              
               )); 
        }
        if($request->session()->has('key'))
        { 
            
            $a=  $request->session()->get('key')->id;
            //Lấy id order mới hoặc id order của user khác
            $new_order=Order::where(['user_id'=>$a,'status'=>'0'])->first();
            //Nếu order mới cập nhập hoặc đăng nhập với id khác
            if($order_id!=$new_order->id)
            return Response::json(array(
            'status'=>'no' ));
            //Khi sản phẩm cũ bị trống
            $p = order_product::withTrashed()->where
            ([
                'order_id'=>$order_id,
                'product_id'=>$product_id
             
            ])->first();
             //Khi trống sản phẩm 
            if(empty($p))
                return Response::json(array(
                'status'=>'no',
                ));
            
            //delete
                //Trừ đi tổng giá đơn hàng order vừa xóa nếu order đó chưa hết hàng
            $c=Order::find($order_id);
            if(!($p->trashed()))
            {   
                $c->total=$c->total-$p->amount;
                $c->save();
                    
            }
                 
                 //Xóa order trong giỏ hàng hiện tại
            $order_product= order_product::where
            ([
                'order_id'=>$order_id,
                'product_id'=>$product_id
            ])->forceDelete();
               
            return Response::json(array(
                    'total'=>$c->total,
                  
                )); 
        }
        
       
    }
    public function addCart(Request $request){
       
        $request->session()->put('change','update');
        $id=$request->product_id;
        if($id=="")
            return abort('404');
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
           if(isset($cart->items[$id]))
           { 
               if($cart->items[$id]['qty']<10 )
               {
                   $cart->add($product);
               }
                else
              {  
                return Response::json(array(
                   'status'=>'error',
                    'message'   => 'Số lượng sản phẩm trong giỏ hàng lớn hơn 10'
                  )); 
              }
            }
           else
           {
            $cart->add($product);
           }
            $request->session()->put('cart',$cart);
             //dd($cart);
         // session()->forget('cart');
           
       
           return redirect()->action('homeController123@cart');
        }
        else
        {
        $user_id=$user->id;
        
       //Kiểm tra xem user_id có tồn tại trong database giỏ hàng
        $carts=Order::where(['user_id'=>$user_id,'status'=>'0'])->first();
        //nếu không tìm được giỏ hàng chứa id đó thì tạo order mới
            
        if(empty($carts))
        {
            $carts=new Order();
            $carts->user_id=$user_id;
            $carts->total=0;
            $carts->status="0";
            $carts->date=Carbon::now();
            $carts->name=$user->name;
            $carts->address=$user->address;
            $carts->phone=$user->phone;
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
            $carts->total=$carts->total+=Product::find($id)->price;
            $carts->save();
        }
        //neu da co san pham thi tagn qty len 1,nếu số lượng lớn hơn 10 thì thông báo lỗi
        elseif($order_product->qty>9)
        {
            return Response::json(array(
                'status'=>'error',
                 'message'   => 'Số lượng sản phẩm trong giỏ hàng lớn hơn 10'
               )); 
        }
        else
        {  
            $order_product::where
            ([
                'order_id'=>$carts->id,
                'product_id'=>$id
            ])->update(['qty'=> $order_product->qty+1,'amount'=>Product::find($id)->price*($order_product->qty+1)]);
             $order_product->save();
            $carts->total=$carts->total+=Product::find($id)->price;
            $carts->save();
        }
       
       
       
            
        }
    }
    
 
}