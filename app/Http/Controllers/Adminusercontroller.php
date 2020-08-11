<?php

namespace App\Http\Controllers;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\role;
use App\role_user;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
class Adminusercontroller extends Controller
{
    public function index(Request $request) {
        $user=$request->session()->get('key');
        if(!empty($user))
        $user=User::find($user->id);
        if (!empty($user)&& $user->can('do')) 
        {
            $orders=User::all();
        return view('admin.user.index')->with(['user'=>$orders]);
        }
        else
        return \abort('403');
       
    }
    public function update($id,Request $request) 
    {
        $user_edited = User::find($id);
            $user=$request->session()->get('key');
        if(!empty($user))
            $user=User::find($user->id);
        if(!empty($user_edited))
        { 
            if (!empty($user)&& $user->can('do')) 
            {
               
                if($user->can('adminEditYourSelf',  $user_edited ))
                    return view('admin.user.view', ['editAminYourself'=>$user_edited ]);
                else if($user->can('editThisAdmin',  $user_edited ))
                    return view('admin.user.view', ['editAdmin'=>$user_edited ]);
                else
                {
                    $request->session()->put(['message'=>"bạn không có quyền chỉnh sửa user này",'alert-class'=>'alert-danger']);
                    return Redirect("admin/user/index");
                }
            }
            else
                return \abort('403');
        }    
        else
           return abort('404');
      
        
    }
    /*public function addRole(Request $request)
    {
       
       // $user_id= $request->role_id;
         $role= $_POST['role_id'];
        $request->session()->put(['message'=>$role,'alert-class'=>'alert-success']);
       /*  $role= $request->role_id;
          
        // $role= $request->role_id;
        
    
       $p = role_user::where(["user_id"=>$user_id,"role_id"=>$role])->first();
        if(empty($p))
        { 
            $a=new role_user();
            $a->user_id=$user_id;
            $a->role_id=$role;
             $a->save(); 
           
            $request->session()->put(['message'=>'Thêm mới thành công','alert-class'=>'alert-success']);
        }
        else
        {  
            
            $request->session()->put(['message'=>'thêm không thành công','alert-class'=>'alert-danger']);
        }
            
       
    }*/
    public function postAddRole(Request $request,$id)
    {
        $user_edited = User::find($id);
        $user=$request->session()->get('key');
        if(!empty($user))
            $user=User::find($user->id);
       
        $role= $_POST['roleUser'];
        $p = role_user::where(["user_id"=>$id,"role_id"=>$role])->first();
        if(empty($p))
        {   
            $a=new role_user();
            $a->user_id=$id;
            $a->role_id=$role;
            $a->save(); 
            $request->session()->put(['message'=>"thêm thành công",'alert-class'=>'alert-success']);
            
        }
        else
        {  
            
            $request->session()->put(['message'=>"thêm không thành công do user đã có role này",'alert-class'=>'alert-danger']);
        }
        if(!empty($user)&&($user->can('adminEditYourSelf', $user_edited)||$user->can('editThisAdmin', $user_edited)))
        {
            return Redirect("admin/user/viewRole/$id");
        }
          
        else
        {   
            $request->session()->forget('message');
            return Redirect("admin/user/index");
        }
        
    }
    public function updateRole($user_id,$role_id,Request $request)
    {
       
        $p = role_user::where(["user_id"=>$user_id,"role_id"=>$role_id])->first();
       
        if(!empty($p))
        { 
            $user=$request->session()->get('key');
            if(!empty($user))
            $user=User::find($user->id);
            if (!empty($user)&& $user->can('do')) 
            {
                
                return view('admin.user.editrole', ['p'=>$p]);
            }
            else
            return \abort('403');
          
            
        }
        else
          return abort('404');
    }
    public function postUpdateROLE($user_id,$role_id,Request $request)
    {
        $role= $_POST['role'];
        $p = role_user::where(["user_id"=>$user_id,"role_id"=>$role])->first();
        if(empty($p) or $role_id ==$role)
        { 
          
            role_user::where(["user_id"=>$user_id,"role_id"=>$role_id])->update(['role_id'=>$role]);
            $request->session()->put(['message'=>'Cập nhập thành công','alert-class'=>'alert-success']);
        }
        else
        {  
            $request->session()->put(['message'=>'User đã có role này','alert-class'=>'alert-danger']);
        }
            
        return Redirect("admin/user/viewRole/$user_id");
    }
    public function deleteRole(Request $request)
    {
        $user_id= $request->user_id;
        $role_id=$request->role_id;
         if($user_id=="")
         return abort('404');
        $p = role_user::where(["user_id"=>$user_id,"role_id"=>$role_id])->delete();
           $request->session()->put(['message'=>'Xoá thành công','alert-class'=>'alert-success']);
        
         
        
            
      
    }
   /* public function update($id,Request $request) {
        $p = User::find($id);
        
        if(!empty($p))
        { 
          
            return view('admin.user.update', ['p'=>$p]);
        }
        else
            return abort('404');
      
        
    }
    public function postUpdate(Request $request, $id) {
        
      
        $p = User::find($id);
     
        
 

        $role = $_POST['role'];
        $c=role_user::where(['user_id'=>$id])->delete();
       
      
      
        foreach($role as $value)
        {
         
            $c=new role_user();
            $c->user_id=$id;
            $c->role_id=$value;
            $c->Save();
      
        }
      
    }*/
}
