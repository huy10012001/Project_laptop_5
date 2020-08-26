<?php

namespace App\Http\Controllers;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Auth;
use App\role_user;
use App\User;
class AdminCategoryController extends Controller
{
    public function index(Request $request) 
    {
        //$request->session()->flush();
        $user=$request->session()->get('key');
        if(!empty($user))
        $user=User::find($user->id);
        
        if (!empty($user)&& $user->can('do')) {
            $categorys = category::all();
            return view('admin.category.index')->with(['categorys'=>$categorys]);
        }
        else
        return \abort('403');
       
    }
    
   
    public function create(Request $request) 
    {
        $user=$request->session()->get('key');
        if(!empty($user))
        $user=User::find($user->id);
        if (!empty($user)&&$user->can('do')) {
            return view('admin.category.create');
        }
        else
        {
            return \abort('403');
        }
      
       
    }
    public function postCreate(CategoryRequest $request) 
    {
        $category = $request->all();
        $c = new category($category);
        $c->slug=SlugService::createSlug(Category::class,'slug',$request->name);
        $c->save();
        $request->session()->put(['message'=>'Tạo thành công','alert-class'=>'alert-success']);
        return redirect()->action('AdminCategoryController@index');
    }
    public function update($id,Request $request)
    {
        $user=$request->session()->get('key');
        if(!empty($user))
        $user=User::find($user->id);
        $p = category::find($id);
        if(empty($p))
            return abort('404');
        else if (!empty($user)&&$user->can('do')) {
            return view('admin.category.update', ['p'=>$p]);
        }
        else
        {
            return \abort('403');
        }
   
       
    }
    public function postUpdate(CategoryRequest $request, $id) 
    {
        $name=$request->input('name');
        $c= category::find($id);
        
        if($c->name !=$name)
        {
            $c->name=$name;
            $c->slug=SlugService::createSlug(Category::class,'slug',$request->name);
        }
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
        $p=Product::where(['category_id'=>$c->id])->first();
        if(!empty($p))
        { 
            $request->session()->put(['message'=>'không thể xóa danh mục này vì có sản phẩm nằm trong danh mục','alert-class'=>'alert-danger']);
           
        }
        else
        {
            $c->delete();
            $request->session()->put(['message'=>'Xóa thành công','alert-class'=>'alert-success']);
        }
      
      
   
      
    
    }
}

