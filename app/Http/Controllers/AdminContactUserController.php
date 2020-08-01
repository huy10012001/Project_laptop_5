<?php

namespace App\Http\Controllers;

use App\category;
use App\contact_user;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class AdminContactUserController extends Controller
{
    public function index() {
        $contact = contact_user::all();
        return view('admin.contact_user.index')->with(['contact_user'=>$contact]);
    }
   
  
   
    public function delete(Request $request) {
        $id=$request->contact_id; 
      
        if($id=="")
          return abort('404');
        $p = contact_user::find($id);
        $p->delete();
         $request->session()->put(['message'=>'Xóa thành công','alert-class'=>'alert-success']);
       
    }
}

