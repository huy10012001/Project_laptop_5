<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\cart_product;
use App\Product;
use PhpParser\Node\Stmt\Break_;
use PhpParser\Node\Stmt\Else_;

class Admincontroller extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function AddCart(Request $request){
       
        // xử lý upload hình vào thư mục
        $user_id=2;
        $cars=Cart::all();
        $flag=false;
      
        foreach($cars as $car)
        {
            if( $car->user_id==$user_id)
            {
                $flag=true;
                 break;
          
            }
        }
            if($flag)
            {
                $c = new Cart();
                $c_p=new cart_product();
                $c_p->cart_id=$c->id();
                $c_p->product_id=2;
                $c->qty=3;
                $c->amount=Product::find(1)->price;
                $c->save();
            }
            else
            { 
               
                $c->qty=1;
                $c->amount=Product::find(2)->price;
                 $c->user_id=$user_id;
                $c->product_id=2;
                $c->save();
            }
            
        
       
        return redirect()->action('homeController@index');
    }
}   
