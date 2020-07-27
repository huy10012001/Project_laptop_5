<?php

namespace App\Http\Controllers;

use App\Cart;
use App\cart_product;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Order;
use App\order_product;
use App\role;

class user_rolecontroller extends Controller
{
    public function index() {
        $orders=role::all();
        
        return view('admin.user_role.index')->with(['role'=>$orders]);
    }
    public function create() {
        //$image = $request->input('image');
       
        return view('order.create');
    }
    public function postCreate(Request $request) {
        // nhận tất cả tham số vào mảng product
        $order = $request->all();
        // xử lý upload hình vào thư mục
       
        $p = new Order($order);
       
        $p->save();
          return redirect()->action('OrderControlr@index')->with(['flash_message'=>'Add product completed']);
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
