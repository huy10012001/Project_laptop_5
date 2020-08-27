<?php

namespace App\Http\Controllers;

use App\Order;
use App\order_product;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Session;
use App\Product;
use App\Cart;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\SocialAccount;
use Illuminate\Support\Facades\URL;

use Laravel\Socialite\One\AbstractProvider;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
       
        if(!Session::has('pre_url')){
        
          
            Session::put('pre_url', URL::previous());
        }else{
            if(URL::previous() != URL::to('login')) Session::put('pre_url', URL::previous());
        }
        
         return Socialite::driver($provider)->redirect();   
    }      
  
    public function handleProviderCallback($provider,Request $request)
    {  
     
        $providerUser = Socialite::driver($provider)->stateless()->user();
       
        if($providerUser->name=="")
            $providerUser->name=$providerUser->nickname;
        
        
        // kiểm tra xem tài khoản social của user có tồn tại chưa
        $account = SocialAccount::whereProvider($provider)
        ->whereprovider_id($providerUser->getId())
        ->first();
        //kiểm tra xem user có tồn tại
        $user = User::whereEmail($providerUser->email)->first();
       
        if(!$account)
        {
            //tạo tài khoản mới
            $account= new SocialAccount();
           
           
            $account->provider = $provider;
            $account->provider_id = $providerUser->id;
         
           
            //nếu user chưa từng đăng ký  thì tạo tài khoản cho user
            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->email,
                    'name' => $providerUser->name,
                    
                ]);
               
            }
            $account->user_id = $user->id;
            $account->save();
           
        }
        $request->session()->put('key',$user);
        
      
       
     //  $authUser = $this->findOrCreateUser($user, $provider);
      // // dd($authUser->id);
      // $request->session()->put('key', $authUser);
      
     
       
        if($request->session()->get('cart'))
        {
            $order= Order::where(['user_id'=>$user->id,'status'=>'0'])->first();
            //Trường hợp giỏ hàng user trống hoặc mua lần đầu tạo order mới
           $cart=new Cart(session()->get('cart'));//cart trong session
           if(empty($order))
           {
               $order=new Order();//cart mới
               $order->user_id= $user->id;
               $order->total=$cart->totalPrice;
               $order->status="0";
               $order->name=$user->name;
               
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
        return Redirect::to(Session::get('pre_url'));
      
       
      /* if ($authUser->can('do')) 
           return Response::json(array(
               'status'=>'admin',
           )); 
       */
        
    }
     
    
    public function findOrCreateUser($user, $provider)
    {
        /*if($provider=="github")
        {if($user->name=="")
            $user->name=$user->nickname;
        }*/
        $authUser = User::where('provider_id', $user->id)->first();
        
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}