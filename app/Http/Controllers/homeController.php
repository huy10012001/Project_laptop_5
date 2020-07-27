<?php

namespace App\Http\Controllers;

use App\category;
use App\product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class homeController extends Controller
{
    public function index(){

        return view('user.home');
    }
   
    public function contact(){
        return view('user.contact');
    }
    public function product($id){
      
            $p = category::find($id);
            if(!empty($p))
            return view('user.product', ['c'=>$p]);
            else
            {
                abort(404);
            }
        }
    
    public function  login(Request $request){
        $value=$request->session()->get('key');
        //lấy giỏ hàng của user_id
        //$carts=Cart::where('user_id',$value)->first();
        //lấy tất cả sản phẩm thuộc giỏ hàng của user
        if(!empty($value))
        {
            return view('user.home')->with('key',$value);
        }
        else
        { 
        // lấy  thông tin sản phẩm 
            //$products=$carts->product;
            return view('login');
        }
       
      

       // return redirect()->action('Admincontroller@index');
       //return view('user.layout_home');

    }

}
