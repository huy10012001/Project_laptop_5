<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use App\Cart;
use App\Order;
use Illuminate\Support\Carbon;
use App\order_product;
use App\User;

class loginController extends Controller
{
    //
    public function index(Request $request)
    {
       
        $value=$request->session()->get('key');
       
        if(!empty($value))
        {
            return redirect()->action('homeController@index');
        }
        else
        { 
        
             return view('login');
        }
       
      
      
     
    }
    public function logout(Request $request)
    {
        $request->session()->forget('key');
        return Redirect::back();
       
    }
   
    public function postLogin(Request $request)
    { 
       
        $hash = $request->input('email');
        $Password=$request->input('password');
        
        $user= User::whereRaw("BINARY `password`= ?", [$Password])->
        whereRaw("BINARY `email`= ?", [$hash])->
        first();
  
       
       if(!empty($user))
       {
       
        
         $request->session()->put('key',$user);
        $order= Order::where(['user_id'=>$user->id,'status'=>'0'])->first();

         if($request->session()->get('cart'))
         {
             //Trường hợp giỏ hàng user trống hoặc mua lần đầu tạo order mới
            $cart=new Cart(session()->get('cart'));//cart trong session
            if(empty($order))
            {
                $order=new Order();//cart mới
                $order->user_id=$user->id;
                $order->total=$cart->totalPrice;
                $order->status="0";
                $order->date=Carbon::now();
                $order->save();
            }
            //Nếu giỏ hàng không trống(kể cả sản phẩm đã hết hàng) thì cập nhập lại tổng giá từ session cart và ngày order hiện tại
            else
            {
                $order->total=$cart->totalPrice;
                $order->status="0";
                $order->date=Carbon::now();
                $order->save();
            }
            //Kiểm tra trong giỏ hiện tại của user nếu có sản phẩm thì xóa đi để lấy dữ liệu từ session cart
            $order_product= Order_product::where([
                'order_id'=>$order->id,
            ])->forceDelete();
            foreach($cart->items as $item)
            {   
              
              
                $order_product=new order_product();
                $order_product->order_id=$order->id;
                $order_product->product_id=$item['id'];
                $order_product->price=$item['price'];
                $order_product->qty=$item['qty'];
                $order_product->amount=$item['amount'];
                $order_product->deleted_at=$item['deleted_at'];
                $order_product->save();
            }

            $request->session()->forget('cart');
         }
         
          return redirect()->action('homeController@index');
       }
       else
       {
        $request->session()->put('alert','đăng nhập không thành công');
         return Redirect::back() ;
       }
       
        //if(!empty($employee))
        //
        
    }
}
