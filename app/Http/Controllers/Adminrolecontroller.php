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
        
        $p = new Role($product);
       
        $p->save();
        $request->session()->put(['message'=>'Thêm thành công','alert-class'=>'alert-success']);
        return redirect()->action('Adminrolecontroller@index');
    }
    public function update($id,Request $request) {
        $p = role::find($id);
        if(!empty($p))
        { 
          
            return view('admin.role.update', ['p'=>$p]);
        }
        else
            return abort('404');
        
    }
    public function postUpdate(Request $request, $id) {
        $name=$request->input('name');
       
        // xử lý upload hình vào thư mục
       
        $p = role::find($id);
        $p->name=$name;
       
        $p->save();
        $request->session()->put(['message'=>'Cập nhập thành công','alert-class'=>'alert-success']);
        return redirect()->action('Adminrolecontroller@index');
        
    }
    public function delete(Request $request) {

        $id=$request->role_id; 
        //Không tìm thấy id thì quay về trang 404
         if($id=="")
            return abort('404');
        $p = role::find($id);
        $p1=$p->user;
        if($p1->count()>0)
            $request->session()->put(['message'=>'Xóa không thành công vì có user thuộc role này','alert-class'=>'alert-danger']);
        else
        {
            $p->delete();
            $request->session()->put(['message'=>'Xóa thành công','alert-class'=>'alert-success']);
        }
        
    }
}

