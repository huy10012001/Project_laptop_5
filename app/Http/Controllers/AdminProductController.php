<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\order_product;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use App\Cart;
use App\Order;

class AdminProductController extends Controller
{
    public function index() {
      // $products = Product::withTrashed()->get();
        $products = Product::all();
       // $products->all();
       
        return view('admin.product.index')->with(['products'=>$products]);
    }
    public function create() {
        //$image = $request->input('image');
       
        return view('admin.product.create');
    }
    public function postCreate(Request $request) {
        // nhận tất cả tham số vào mảng product
        $product = $request->all();
        // xử lý upload hình vào thư mục
        if($request->hasFile('image'))
        {
            $file=$request->file('image');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'png' && $extension !='jpeg')
            {
                return redirect('product/create')->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $imageName = $file->getClientOriginalName();
            $file->move("images",$imageName);
        }
        else
        {
            $imageName = null;
        }
         $p = new Product($product);
           $category= $_POST['category'];
          $p->category_id = $category;
        $p->image=$imageName;
        $p->save();
//
       return redirect()->action('AdminProductController@index');
    }
    public function update($id) {
        $p = Product::find($id);
        return view('admin.product.update', ['p'=>$p]);
    }
    public function postUpdate(Request $request, $id) {
        $name=$request->input('name');
        $price=$request->input('price');
       
        $category= $_POST['category'];
        // xử lý upload hình vào thư mục
        if($request->hasFile('image'))
        {
            $file=$request->file('image');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'png' && $extension !='jpeg')
            {
               // return redirect('product/update/')->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
                return Redirect::back()->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $imageName = $file->getClientOriginalName();
            $file->move("images",$imageName);
        } else { // không upload hình mới => giữ lại hình cũ
            $p = Product::find($id);
            $imageName = $p->image;
        }
        $p = Product::find($id);
        $p->name=$name;
        $p->price=$price;
        $p->category_id=$category;
        $p->image = $imageName;

        $p->save();
    
        //update lại tổng  giá sản phẩm trong giỏ hàng
         order_product::join('product', 'order_product.product_id', '=', 'product.id')
         ->join('order','order_product.order_id','=','order.id')
         ->where(
            ['product.id'=>$id
            ,'order.status'=>'0']
         )
         ->update(['order_product.price' => Product::find($id)->price,'order_product.amount'=>DB::raw('product.price*order_product.qty' )]);
        
        //update lại tổng thành tiền
        //query 
        $carts= DB::table('order')
        ->leftJoin(DB::raw('(Select order_product.order_id,SUM(order_product.amount) as count
        FROM order_product,`order`
        WHERE `order`.id=order_product.order_id  and deleted_at is null 
          GROUP BY (order_product.order_id)
          ) as T'), function ($join) {
              $join->on ( 'T.order_id', '=', 'order.id' );
          })
          ->where(['order.status'=>'0'])
          ->whereNotNull('T.count')
          ->update(['total'=>DB::raw('T.count' )]);

         /*$carts=cart::all();
        foreach($carts as $c)
        {
            $total=0;
            foreach($c::find($c->id)->product as $p)
            {
                $total +=$p->pivot->amount;
                }
            $c->total=$total;
            $c->save();
        }*/
        return redirect()->action('AdminProductController@index');
        
    }
    public function delete($id) {
        $p = Product::find($id);
         $p->delete();
        $carts=order_product::join('product', 'order_product.product_id', '=', 'product.id')
         ->join('order','order_product.order_id','=','order.id')
         ->where(
            ['product.id'=>$id
            ,'order.status'=>'0']
         );
        $carts->delete();
        $price=Product::withTrashed()->find($id)->price;
        if(!empty($carts->withTrashed()->first()))
        { 
           
            $carts= DB::table('order')->setBindings([$id])
        ->leftJoin(DB::raw('(
            SELECT total-(price*qty)  AS Decreamount,order_product.order_id
            from order_product,`order`
            WHERE order_product.order_id=`order`.id AND product_id=?
          ) as T'), function ($join) {
            $join->on ( 'T.order_id', '=', 'order.id' );
          })->where(['order.status'=>'0'])
          ->whereNotNull('T.Decreamount')
          ->update(['total'=>DB::raw('T.Decreamount' )]);
        }
        

        
        return redirect()->action('AdminProductController@index');
    }
}

