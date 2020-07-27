<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class Adminrolecontroller extends Controller
{
    public function index() {
        $products =role::all();
        return view('admin.role.index')->with(['role'=>$products]);
    }
    public function create() {
        //$image = $request->input('image');
       
        return view('admin.role.create');
    }
    public function postCreate(Request $request) {
        // nhận tất cả tham số vào mảng product
        $product = $request->all();
        // xử lý upload hình vào thư mục
        
        $p = new Product($product);
       
        $p->save();

        return redirect()->action('Adminrolecontroller@index');
    }
    public function update($id) {
        $p = role::find($id);
        return view('admin.role.update', ['p'=>$p]);
    }
    public function postUpdate(Request $request, $id) {
        $name=$request->input('name');
       
        // xử lý upload hình vào thư mục
       
        $p = role::find($id);
        $p->name=$name;
       
        $p->save();
        return redirect()->action('Adminrolecontroller@index');
        
    }
    public function delete($id) {
        $p = role::find($id);
        $p->delete();
        return redirect()->action('Adminrolecontroller@index');
    }
}

