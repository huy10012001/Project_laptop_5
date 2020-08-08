<?php

namespace App\Http\Controllers;

use App\Cart;
use App\cart_product;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Order;
use App\order_product;
use App\role;
use App\User;
class user_rolecontroller extends Controller
{
    public function index(Request $request) {
        $user=$request->session()->get('key');
        $user=User::find($user->id);
        if (!empty($user)&& $user->can('do')) 
        {
            $orders=role::all();
        
            return view('admin.user_role.index')->with(['role'=>$orders]);
        }
        else
        return \abort('403');
        
    }
   
  
    public function delete($user_id,$role_id) {
       
       $p = Order_product::where([
           'user_id'=>$user_id,
            'role_id'=>$role_id
            
        ]);
         $p->delete();
        return redirect()->action('user_rolecontroller@index');
    }
   
}
