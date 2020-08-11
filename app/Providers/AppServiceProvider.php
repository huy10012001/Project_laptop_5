<?php

namespace App\Providers;
use App\Product;
use App\Cart;
use App\category;
use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Order;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout_home', function($view)
        {
                $value=Session::get('key');
                if(!empty($value))
                { 
                    $user_id=$value->id;
                //lấy giỏ hàng của user_id
                $orders=Order::where(['user_id'=>$user_id,'status'=>'0'])->first();
              
                $view->with(['orders'=>$orders]);
                }
           

         
        });

    }
}
