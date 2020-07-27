<?php

namespace App\Http\Controllers;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Order;
use App\order_product;

class AdminOrderController extends Controller
{
    public function index() {
        $orders=Order::all();
        return view('admin.order.index')->with(['orders'=>$orders]);
    }
    public function view($id) {
        
        $p = Order::find($id);
    
       return view('admin.order.view', ['p'=>$p]);
   }
    public function update($id) {
        
        $p = Order::find($id);
       return view('admin.order.update', ['p'=>$p]);
   }
   public function postUpdate(Request $request, $id) {

        $status= $_POST['status'];
       $c=  Order::find($id);
       $c->status=$status;
        $c->save();
    
       return redirect()->action('AdminOrderController@index');
       
   }
   public function delete($id) {
       $c=Order::where('status','1')->get();
       $c=$c->find($id);
       if(!empty($c))
            $c->delete();
   
      // $c= $c->find($id)->delete();
       
      
      return redirect()->action('AdminOrderController@index');
   }
}
