<?php

namespace App\Http\Controllers;
use App\Cart;
use Illuminate\Http\Request;
use App\Product;
use App\cart_product;
use App\Events\Qty;
use App\Order;
use App\order_product;
use Illuminate\Validation\Rules\Exists;

class homeController123 extends Controller
{
    
    public function cart(Request $request){
        $value=$request->session()->get('key');
     
        //check user da dang nhap neu chua quya lai login
        if(empty($value))
        {
          //  return redirect()->action('loginController@index');
        
          return view('user.cart_detail');

        }
        else
        {
            $user_id=$value->id;
            //lấy giỏ hàng của user_id
            $orders=Order::where(['user_id'=>$user_id,'status'=>'0'])->first();
          
            if(!empty($orders))
            {
               
              // $products=Order::find($orders->id)->product;
               //nếu có sản phẩm khi show sản phẩm trong giỏ hàng của user
               /// if(count($products)>0)
                    return view('user.cart_detail')->with(['orders'=>$orders]);
                //echo $products;
               // else
                //return view('user.cart_detail');
            }
            else
            {
                return view('user.cart_detail');
            }
           
    
         }
        
       
       // return redirect()->action('Admincontroller@index');
      
    }
    public function delete($order_id,$product_id) {
       
        
       /* $p = order_product::where([
            'order_id'=>$order_id,
             'product_id'=>$product_id
             
         ])->first();
         $c=Order::find($order_id);
         echo $p->price;
         $c->total=$c->total-$p->price;
         $c->save();
         $p->delete();
        */
         return redirect()->action('homecontroller@index');
     }
    public function index(){
       
        $products= Product::all();
       // return redirect()->action('Admincontroller@index');
       return view('user.home')->with('product',$products);
    }
    public function contact(Request $request){
       
       
    
        $value=$request->session()->get('key');
        //lấy giỏ hàng của user_id
        $carts=Cart::where('user_id',$value)->first();
        //lấy tất cả sản phẩm thuộc giỏ hàng của user
        if(empty($value))
        {
            return redirect()->action('loginController@login');
        }
        elseif(!empty($carts))
        { 
        // lấy  thông tin sản phẩm 
            //$products=$carts->product;
            return view('user.layout_home')->with(['carts'=>$carts,'id'=>$value]);
        }
        else
        { 
            return view('user.layout_home');

        }
      
    }
    public function product(){
        return view('user1.product');
    }
    public function  login(){
        return view('login');

       // return redirect()->action('Admincontroller@index');
       return view('user.layout_home');

    }
}
