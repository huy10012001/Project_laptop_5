<?php

namespace App\Http\Controllers;

use App\category;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class AdminCategoryController extends Controller
{
    public function index() 
    {
        $categorys = category::all();
        return view('admin.category.index')->with(['categorys'=>$categorys]);
    }
    public function create() 
    {
        return view('admin.category.create');
       
    }
    public function postCreate(Request $request) 
    {
        $category = $request->all();
        $c = new category($category);
        $c->save();
        $request->session()->put(['message'=>'Tạo thành công','alert-class'=>'alert-success']);
        return redirect()->action('AdminCategoryController@index');
    }
    public function update($id)
    {
       $p = category::find($id);
        if(!empty($p))
            return view('admin.category.update', ['p'=>$p]);
        else
        {
            return abort('404');
        }
    }
    public function postUpdate(Request $request, $id) 
    {
        $name=$request->input('name');
        $c= category::find($id);
        $c->name=$name;
        $c->save();
        $request->session()->put(['message'=>'Cập nhập thành công','alert-class'=>'alert-success']);
        return redirect()->action('AdminCategoryController@index');
        
    }
    public function delete(Request $request) {
        $id=$request->category_id; 
        //Không tìm thấy id thì quay về trang 404
        if($id=="")
            return abort('404');
        $c=category::find($id);
        $c->delete();
        $request->session()->put(['message'=>'Xóa thành công','alert-class'=>'alert-success']);
      
   
      
    
    }
}

