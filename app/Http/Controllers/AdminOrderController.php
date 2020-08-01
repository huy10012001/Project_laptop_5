<?php

namespace App\Http\Controllers;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Order;
use App\order_product;

class AdminOrderController extends Controller
{
    public function index() {
        $orders=Order::where('total', '<>' ,'0')->get();
        return view('admin.order.index')->with(['orders'=>$orders]);
    }
    public function view($id) {
        
        $p = Order::find($id);
    
       return view('admin.order.view', ['p'=>$p]);
   }
    public function update($id,Request $request) 
    {
        
        $p = Order::find($id);
        if(empty($p)  )
          return abort('404');
       
        elseif($p->status=="0")
        {
            $request->session()->put(['message'=>'Không thể cập nhập vì đơn chưa check out xong','alert-class'=>'alert-danger']);
            return redirect()->action('AdminOrderController@index');
        }
        else
        {
            return view('admin.order.update', ['p'=>$p]);
        }
       
      
   }
   public function postUpdate(Request $request, $id) {

        $status= $_POST['status'];
        $c=  Order::find($id);
        $c->status=$status;
        $c->save();
    
       return redirect()->action('AdminOrderController@index');
       
   }
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
     
   }
}
