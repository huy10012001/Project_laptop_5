<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class loginController extends Controller
{
    //
    public function index(Request $request)
    {
       
        $value=$request->session()->get('key');
       
        if(!empty($value))
        {
            return redirect()->action('homeController@index');
        }
        else
        { 
        
             return view('login');
        }
       
      
      
     
    }
    public function logout(Request $request)
    {
        $request->session()->forget('key');
        return Redirect::back();
       
    }
   
    public function postLogin(Request $request)
    { 
       
        $Email_Id = $request->input('email');
        $Password=$request->input('password');
        
        
        $user= DB::table('user') 
        ->where([
            'email'=>$Email_Id,
            'password'=>$Password
            
        ])->first();
       
       if(!empty($user))
       {
       
       
         $request->session()->put('key',$user);
        return redirect()->action('homeController@index');
       }
       else
       {
       
        return Redirect::back();
       }
       
        //if(!empty($employee))
        //
        
    }
}
