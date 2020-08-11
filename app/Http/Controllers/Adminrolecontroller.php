<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\RoleRequest;
use App\Product;
use App\role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\User;
class Adminrolecontroller extends Controller
{
    public function index(Request $request) {
        $user=$request->session()->get('key');
        if(!empty($user))
        $user=User::find($user->id);
        if (!empty($user)&& $user->can('do')) 
        {
            $products =role::all();
            return view('admin.role.index')->with(['role'=>$products]);
        }
        else
        return \abort('403');
      
    }
    public function create(Request $request) {
        //$image = $request->input('image');
        $user=$request->session()->get('key');
        if(!empty($user))
        $user=User::find($user->id);
        if (!empty($user)&& $user->can('do')) 
        {
            return view('admin.role.create');
        }
        else
        return \abort('403');
        
    }
    public function postCreate(RoleRequest $request) {
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
        if($p->name=="admin" ||$p->name=="super admin")
        {$request->session()->put(['message'=>'không thể sửa role này','alert-class'=>'alert-danger']);
        return redirect()->action('Adminrolecontroller@index');
        }
       
        if(!empty($p))
        { 
            $user=$request->session()->get('key');
            if(!empty($user))
             $user=User::find($user->id);
            if (!empty($user)&& $user->can('do')) 
            {
            return view('admin.role.update', ['p'=>$p]);
            }
        else
        return \abort('403');
          
          
        }
        else
            return abort('404');
        
    }
    public function postUpdate(RoleRequest $request, $id) {
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
        if($p->name=="admin" ||$p->name=="super admin")
        {
            $request->session()->put(['message'=>'không thể xóa role này','alert-class'=>'alert-danger']);
            return redirect()->action('Adminrolecontroller@index');
        }
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

