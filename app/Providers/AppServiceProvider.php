<?php

namespace App\Providers;
use App\Product;
use App\Cart;
use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Session;
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
        view()->composer('header',function($view)
        {
 
            $loai_sp=Product::all();
          
            if(Session('cart'))
            {
                $oldCard=Session::get('cart');
                $cart=new Cart($oldCard);

            }
            $view->with('loai_sp',$loai_sp);
        });

    }
}
