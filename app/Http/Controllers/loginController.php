<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use App\Cart;
use App\Http\Requests\loginRequest;
use App\Order;
use Illuminate\Support\Carbon;
use App\order_product;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\register;
use App\Http\Requests\registerRequest;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\ProductRequest;
class loginController extends Controller
{
    //

    public function index(Request $request)
    {
        $value=$request->session()->get('key');
        //lấy url trước
       // $a=url()->previous();
        //if($a!=url()->current())
       // {
            // nếu url trước khác  url hiện tại thì lấy url trang trước
         //  $request->session()->put('url',url()->previous());
        //}
        if(!empty($value) )
        {
            $user=User::find($value->id);
          
            foreach($user->role as $role)
            {
               //nếu có role admin hoặc super admin quay lại trang admin
              
               if($role->name=="admin" ||$role->name=="super admin")
               
               return  redirect('admin/laptopshop');
            }
            return view('login');
         
        }
        else
            return view('login');
        
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
        $user_id=$request->user_id;
        //lấy order của user hiện tại
       // $current_order=Order::where(['user_id'=>$a->id,'status'=>'0'])->first()->id;
       
        // so sánh xem user có vừa đăng nhập tài khoản khác không
        if($a->id!=$user_id && !empty($user_id))
        {
            return Response::json(array(
                'status'=> 'phiên kết thúc'
               )); 
        }
        $status=$request->status;   
       /* $orders=Order::where(['user_id'=>$a->id,'status'=>'0'])->first();
        if(empty($orders))
         return Response::json(array(
            'status'=> 'giỏ hàng bạn đang trống'
           )); 
        else if($orders->total==0)
        {
            return Response::json(array(
                'status'=> 'giỏ hàng bạn đang trống'
               )); 
        }*/
        if(!empty($a) &&!empty($status))
        {
            return Response::json(array(
                'status'=> 'đăng nhập'
               )); 
        }
       
        if(!empty($a) &&empty($status))
        {
            return Response::json(array(
                'status'=> 'phiên kết thúc'
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
       // $request->session()->forget('cart');
       
    }
    
   
    public function postRegisterCheckOut(registerRequest   $request)
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
      

        if($request->session()->get('cart'))
        {      
             //Trường hợp user mua lần đầu hoặc user order mới thì tạo order mới
            $cart=new Cart(session()->get('cart'));//cart trong session
            $order=new Order();//cart mới
            $order->user_id=$user->id;
            $order->status="0";
            $order->total="0";
            $order->name=$name;
            $order->phone=$phone;
            $order->address=$address;
            $order->save();
            $total=0;
             foreach($cart->items as $item)
             {   
                if(Product::find($item['id'])->status=="1")
                $total+=Product::find($item['id'])->price*$item['qty'];
                 $order_product=new order_product();
                 $order_product->order_id=$order->id;
                 $order_product->product_id=$item['id'];
                 $order_product->price=Product::find($item['id'])->price;
                $order_product->qty=$item['qty'];
                $order_product->amount=Product::find($item['id'])->price*$item['qty'];
                $order_product->created_at=\Carbon\Carbon::parse($item['time_at']);
                 $order_product->save();
             }
             //ngày mau sản phẩm đầu tiên
             $order->date=\Carbon\Carbon::parse(array_values($cart->items)[0]['time_at']); 
             $order->total=$total;
             $order->save();
             $request->session()->forget('cart');
        }
        
         return Response::json(array(
            'status'=>'Thành công',
          
           )); 
        
    }
   
    public function postLoginCheckOut(loginRequest $request)
    { 
        //Khi user đã đăng nhập ở tab khác
       
      
        $email = $request->input('email');
        $password=$request->input('password');
    
        $user= User::where(["email"=>$email,"password"=>$password])->
        first();   
        
        if(!empty($user))
       {
      
        $request->session()->put('key',$user);
        
        $order= Order::where(['user_id'=>$user->id,'status'=>'0'])->first();
         
        /*
        if(empty($order))
         return Response::json(array(
            'status'=> 'giỏ hàng bạn đang trống'
           )); 
        else if($order->total==0)
        {
            return Response::json(array(
                'status'=> 'giỏ hàng bạn đang trống'
               )); 
        }   
        */
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
                $order->name=$user->name;
                $order->phone=$user->phone;
                $order->address=$user->address;
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
                $order->name=$user->name;
                $order->phone=$user->phone;
                $order->address=$user->address;
                $order->save();
            }
            //Kiểm tra trong giỏ hiện tại của user nếu có sản phẩm thì xóa đi để lấy dữ liệu từ session cart
            
            $order_product= Order_product::where([
                'order_id'=>$order->id,
            ])->delete();
            $total=0;
            foreach($cart->items as $item)
            {   
              
                if(!empty(Product::find($item['id'])))
                { 
                    if(Product::find($item['id'])->status=="1")
                        $total+=Product::find($item['id'])->price*$item['qty'];
                    $order_product=new order_product();
                    $order_product->order_id=$order->id;
                     $order_product->product_id=$item['id'];
                     $order_product->price=Product::find($item['id'])->price;
                    $order_product->qty=$item['qty'];
                     $order_product->amount=Product::find($item['id'])->price*$item['qty'];
                     $order_product->created_at=\Carbon\Carbon::parse($item['time_at']);
                     $order_product->save();
                }
            }
            $order->date=\Carbon\Carbon::parse(array_values($cart->items)[0]['time_at']); 
            $order->total=$total;
            $order->save();
            $request->session()->forget('cart');
         }
      
         $url=$request->session()->get('url');
        
        if ($user->can('do')) 
            return Response::json(array(
                'status'=>'admin',
            )); 
        
        else
         return Response::json(array(
            'status'=>'Thành công',
           
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
