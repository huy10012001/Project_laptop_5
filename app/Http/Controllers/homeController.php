<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\category;
use App\contact_user;
use App\DetailProduct;
use App\Order;
use App\product;
use App\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
USE Illuminate\Support\Facades\Redirect;  
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
class homeController extends Controller
{
    public function detail(Request $request){
        
        return view('detail');
    }
    public function index(Request $request){
     $cart=$request->session()->get('cart');
        dd($cart);
    }

    public function order(Request $request){

        //$request->session()->flush();
        //$request->session()->forget('change');
        $value=$request->session()->get('key');
        
        //check user da dang nhap neu chua quya lai login
        if(empty($value))
        {
         
          
           //lấy url trang trước
            return view('user.order');
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
                    return view('user.order')->with(['orders'=>$orders]);
                //echo $products;
               // else
                //return view('user.cart_detail');
            }
            else
            {
                return view('user.order');
            }
           
    
         }
    }
    public function home(Request $request){

        //$request->session()->flush();
        return view('user.home');
    }
   
    public function checkout(){
        return view('user.contact');
    }
    public function contact(){
        return view('user.contact');
    }
   
    public function product ($name)
    { 
        $name=str_replace("-", " ", $name);
        $category = category::where(['name'=>$name])->first();
      
        if(!empty($category))
            $product=Product::where(['category_id'=>$category->id,'status'=>"1"]);
        if(!empty($category)&&$product->count()>0)
        { 
            $product=$product->paginate(6);
            
            return view('user.product', ['c'=>$category,'product'=>$product]);
        }
        else
        {
            $product=Product::where(['name'=>$name,'status'=>"1"])->first();
            if(!empty($product))
            {    
                $detail_product=DetailProduct::where(['product_id'=>$product->id])->first();
                $category=category::find($product->category_id);
                if(!empty($detail_product))
                {
                    return view('detail')->with(['p'=>$product,'c'=>$category]);
                }
                else
                {
                    return view('detail');
                    
                }
            }
            else 
            {
                $product_noactive=Product::where(['name'=>$name,'status'=>"0"])->first();
                if(!empty($product_noactive))
                    return view('detail')->with(['noactive'=>$product_noactive]);
                else
                return \abort('404');
            }
        }
        
    }
    public function postContact(Request $request) 
    {
        $name = $request->input('ct_name');
        $email = $request->input('ct_email');
        $phone = $request->input('ct_phone');
        $title = $request->input('ct_title');
        $mess=$request->input('ct_message');
         $c = new contact_user();
         $c->name=$name;
         $c->email=$email;
         $c->phone=$phone;
         $c->subject=$title;
         $c->message=$mess;
         $c->save();
         return Redirect::Back();
       
    }
    

}
