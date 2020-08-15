<?php

namespace App\Http\Controllers;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\order_product;
use Illuminate\Support\Facades\Redirect;

class AdminOrderController extends Controller
{
    public function index(Request $request) {
        $user=$request->session()->get('key');
        if(!empty($user))
        $user=User::find($user->id);
        
        if (!empty($user)&& $user->can('do')) {
            $orders=Order::where('total', '<>' ,'0')->get();
             return view('admin.order.index')->with(['orders'=>$orders]);
        }
        else
        return \abort('403');
      
    }
    public function view($id,Request $request) {
        
        $p = Order::find($id);
        if(empty($p))
            return abort('404');
        else
        {
            $user=$request->session()->get('key');
            if(!empty($user))
            $user=User::find($user->id);
            if (!empty($user)&& $user->can('do')) {
           
                return view('admin.order.view', ['p'=>$p]);
            }
            else
            return \abort('403');
        }
       

   }
   public function edit(Request $request)
   {
     $order_id=$request->order_id;
     if(empty($order_id))
     return \abort('404');
     $status=$request->status;
     $c=  Order::find($order_id);
     $c->status=$status;
     $c->save();
     $request->session()->put(['message'=>'cập nhập thành công','alert-class'=>'alert-success']);
   }
   
   public function update($id,Request $request) 
    {
        
        $p = Order::find($id);
        if(empty($p)  )
          return abort('404');
          else
          {
              $user=$request->session()->get('key');
              if(!empty($user))
              $user=User::find($user->id);
              if (!empty($user)&& $user->can('do')) 
              {
                if($p->status=="0")
                {
                    $request->session()->put(['message'=>'Không thể cập nhập vì đơn chưa check out xong','alert-class'=>'alert-danger']);
                    return redirect()->action('AdminOrderController@index');
                }
                else
                {
                    return view('admin.order.update', ['p'=>$p]);
                }
             
              }
              else
              return \abort('403');
          }
       
      
   }
   public function postUpdate(Request $request, $id) {

        $status= $_POST['status'];
        $c=  Order::find($id);
        $c->status=$status;
        $c->save();
        $request->session()->put(['message'=>'cập nhập thành công','alert-class'=>'alert-success']);
       return Redirect::back();
       
   }
   /*
   public function delete(Request $request) {
        $id=$request->order_id; 
        if($id=="")
        return abort('404');
       // $c=Order::where(['status'=>'1'])->get();
        $c= Order::find($id);
        if($c->status=="0")
             $request->session()->put(['message'=>'Không thể xóa vì đơn hàng chưa hoàn thành','alert-class'=>'alert-danger']);
        else
        {
            $c->delete();
            $request->session()->put(['message'=>'xóa thành công','alert-class'=>'alert-success']);
        }
     
   }*/
}
