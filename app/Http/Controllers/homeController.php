<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\category;
use App\contact_user;
use App\product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
USE Illuminate\Support\Facades\Redirect;        
class homeController extends Controller
{
    public function home(Request $request){

        //$request->session()->flush();
        return view('user.home');
    }
    public function index(Request $request){

        //$request->session()->flush();
        return view('user.cart_detail');
    }
   
    public function contact(){
        return view('user.contact');
    }
    public function product($name)
    {

       
        $p = category::withTrashed()->where(['name'=>$name])->first();
        if(!empty($p) and $p->product->count()>0)
      
           return view('user.product', ['c'=>$p]);
        else
         {
             abort(404);
        }
    }
    public function postContact(Request $request) 
    {
        $name = $request->input('ct_name');
        $email = $request->input('ct_email');
        $phone = $request->input('ct_phone');
        $title = $request->input('ct_title');
        $mess=$request->input('ct_content');
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
