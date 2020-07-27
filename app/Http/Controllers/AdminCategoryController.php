<?php

namespace App\Http\Controllers;

use App\category;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index() {
        $categorys = category::all();
        return view('admin.category.index')->with(['categorys'=>$categorys]);
    }
    public function create() {
        //$image = $request->input('image');
       
        return view('admin.category.create');
    }
    public function postCreate(Request $request) {
        // nhận tất cả tham số vào mảng product
        
        $category = $request->all();
        // xử lý upload hình vào thư mục
        
        $c = new category($category);
       $c->save();
       return redirect()->action('AdminCategoryController@index');
      
    }
    public function update($id) {
        
         $p = category::find($id);
        return view('admin.category.update', ['p'=>$p]);
    }
    public function postUpdate(Request $request, $id) {

        $name=$request->input('name');
        $c= category::find($id);
        $c->name=$name;
      $c->save();
     
        return redirect()->action('AdminCategoryController@index');
        
    }
    public function delete($id) {
        $c= category::find($id);
        $p = Product::
        where('category_id', $id)
        ->delete();
        $c->delete();
        return redirect()->action('AdminCategoryController@index');
    }
}

