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
   
  
   
    public function delete($id) {
        $p = contact_user::find($id);
        $p->delete();
        return redirect()->action('AdminContactUserController@index');
    }
}

