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
use Illuminate\Support\Facades\Response;
class loginController extends Controller
{
    //
    public function index(Request $request)
    {
        $value=$request->session()->get('key');
        //lấy url trước
        $a=url()->previous();
        if($a!=url()->current())
        {
            // nếu url trước khác  url hiện tại thì lấy url trang trước
           $request->session()->put('url',url()->previous());
        }
        if(!empty($value))
        {
          
            return Redirect::to( $request->session()->get('url'));
        }
        else
        { 
        
             return view('login');
        }
    }
    public function checkDangNhap(Request $request)
    {
        
        if(empty($request->check))
        {
            return abort('404');
        }
        $a=$request->session()->get('key');
           if(empty($a))
        {
            return Response::json(array(
                'status'=>'thoát đăng nhập'
               )); 
        }
        //order id tab hiện tại
        $order_id=$request->order_id;
        //lấy order của user hiện tại
        $current_order=Order::where(['user_id'=>$a->id,'status'=>'0'])->first()->id;
       
        // so sánh xem user có vừa đăng nhập tài khoản khác không
        if(!empty($order_id) && $order_id !=$current_order)
        {
            return Response::json(array(
                'status'=> 'phiên kết thúc'
               )); 
        }
        $status=$request->status;   
        
        if(!empty($a) &&!empty($status))
        {
            return Response::json(array(
                'status'=> 'đăng nhập'
               )); 
        }
     
    }
    public function logout(Request $request)
    {
        if(empty($request->logout))
        {
            return abort('404');
        }
        $request->session()->forget('key');
        $request->session()->forget('cart');
       
    }
    public function postRegisterCheckOut(Request $request)
    {
        $name = $request->input('name');
        $phone=$request->input('SĐT');
        $email = $request->input('email');
        $Password=$request->input('password');
        $address=$request->input('address');
        $user=new User();
        $user->name=$name;
        $user->email=$email;
        $user->password=$Password;
        $user->phone=$phone;
        $user->address=$address;
        $user->save();
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
                $order->delete();
                $order=new Order();
                $order->user_id=$user->id;
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
         
         return Response::json(array(
            'status'=>'Thành công',
          
           )); 
        
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
                $order->status="1";
                $order->date=Carbon::now();
                $order->save();
            }
            //Nếu giỏ hàng không trống(kể cả sản phẩm đã hết hàng) thì xóa giỏ cũ, cập nhập lại tổng giá từ session cart và ngày order hiện tại
          
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
                
                //$order_product->created_at=\Carbon\Carbon::parse($item['time_at']);
                $order_product->deleted_at=$item['deleted_at'];
                $order_product->save();
            }

            $request->session()->forget('cart');
         }
        
        
            return Redirect::to( $request->session()->get('url'));
        
       }
       else
       {
      
        return Redirect::back();
       
       }
       
        
        
    }
    public function postLoginCheckOut(Request $request)
    { 
        //Khi user đã đăng nhập ở tab khác
       

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
                //$order->delete();
                //$order=new Order();
                $order->user_id=$user->id;
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
                $order_product->created_at=\Carbon\Carbon::parse($item['time_at']);
                $order_product->deleted_at=$item['deleted_at'];
                $order_product->save();
            }

            $request->session()->forget('cart');
         }
         $url=$request->session()->get('url');
         return Response::json(array(
            'status'=>'Thành công',
            'url'=>$url
           )); 
         
       }
       else
       {
        return Response::json(array(
            'status'=>'Đăng nhập không thành công',
          
           )); 
       }
       
        //if(!empty($employee))
        //
        
    }
}
