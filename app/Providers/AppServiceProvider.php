<?php

namespace App\Providers;
use App\Product;
use App\Cart;
use App\category;
use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
              //lấy danh mục có ít nhất 1 sản phẩm cập nhập đầy đủ chi tiết và đang hoạt động
            $category= DB::table('category')->select('category.name')->distinct()
            -> join('product','product.category_id','=','category.id')
            ->join('detail_product','detail_product.product_id','=','product.id')->
            where('product.status','1')->get();
           
                if(Session::has('cart'))
                {
                    $cart=Session::get('cart');
                    $totalQty=0;
                    foreach($cart->items as $item)
                    {
                        if(Product::find($item['id'])->status=="1")
                        $totalQty+=$item['qty'];
                    }
                    $view->with(['totalQty'=>$totalQty]);
                }
                $value=Session::get('key');
                if(!empty($value))
                { 
                    $user_id=$value->id;
                //lấy giỏ hàng của user_id
                    $orders=Order::where(['user_id'=>$user_id,'status'=>'0'])->first();
                     $totalQty=0;
                     if(!empty($orders))
                    {foreach($orders->product as $item)
                     {  
                         if($item->status=="1")
                         $totalQty+=$item->pivot->qty;
                     }
                     $view->with(['totalQty'=>$totalQty]);
                    }
                $view->with(['orders'=>$orders,'category'=>$category]);
                }
           

         
        });

    }
}
