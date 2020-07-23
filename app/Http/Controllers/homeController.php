<?php

namespace App\Http\Controllers;

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
    public function product(){
        return view('user.product');
    }
    public function  login(){
        return view('login');

       // return redirect()->action('Admincontroller@index');
       return view('user.layout_home');

    }

}
