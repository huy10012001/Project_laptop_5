<?php

namespace App\Http\Controllers;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Order;
use App\User;
class Adminusercontroller extends Controller
{
    public function index() {
        $orders=User::all();
        return view('admin.user.index')->with(['user'=>$orders]);
    }
  
}
