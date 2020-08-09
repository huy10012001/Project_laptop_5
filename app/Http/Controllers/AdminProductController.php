<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\order_product;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Cart;
use App\Order;
use App\User;
class AdminProductController extends Controller
{
    public function postDetailProduct(Request $request)
    {
        $d1=$request->except('_token');
        $request->session()->put('detail',json_encode($d1));
       
        return Response::json(array(
            'name'=>$d1,
           
          
         )); 
    }
    public function index(Request $request) 
    {
        $user=$request->session()->get('key');
            if(!empty($user))
        $user=User::find($user->id);
        
        if (!empty($user)&& $user->can('do')) {
            $products = Product::all();
            return view('admin.product.index')->with(['products'=>$products]);
        }
        else
        return \abort('403');
        
    }
    public function create(Request $request)
    {  
       
      
            $user=$request->session()->get('key');
            if(!empty($user))
            $user=User::find($user->id);
            if (!empty($user)&& $user->can('do')) 
            {
          
            return view('admin.product.create');
            }
            else
            return \abort('403');
        
    }
    public function postCreate(ProductRequest $request) 
    {
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
        if(empty($imageName))
        {
            $request->session()->put(['message'=>'Thiếu ảnh','alert-class'=>'alert-danger']);
            return Redirect::back();
        }
        $p = new Product($product);
        $category= $_POST['category'];
        $p->category_id = $category;
       
        $p->image=$imageName;
        $p->save();
        $request->session()->put(['message'=>'Thêm mới thành công','alert-class'=>'alert-success']);
        return redirect()->action('AdminProductController@index');
    }
    public function update($id,Request $request)
    {
        
        $p = Product::find($id);
        if(!empty($p))
        { 
            $user=$request->session()->get('key');
            if(!empty($user))
            $user=User::find($user->id);
            
            if (!empty($user)&& $user->can('do')) 
            {
               
                return view('admin.product.update', ['p'=>$p]);
            }
            else
            return \abort('403');
           
        }
        else
            return abort('404');
    }

    public function postUpdate(ProductRequest $request, $id) 
    {
        $name=$request->input('name');
        $price=$request->input('price');
        $description=$request->input('description');
        $category= $_POST['category'];
        // xử lý upload hình vào thư mục
        if($request->hasFile('image'))
        {
            $file=$request->file('image');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'png' && $extension !='jpeg')
            {
               return Redirect::back()->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $imageName = $file->getClientOriginalName();
            $file->move("images",$imageName);
        } 
        else 
        { // không upload hình mới => giữ lại hình cũ
            $p = Product::find($id);
            $imageName = $p->image;
        }
        $p = Product::find($id);
        $p->name=$name;
       
        $p->category_id=$category;
        $p->image = $imageName;
        $p->description= $description;
        //trường hợp user đã đăng nhập
        //update lại tổng  giá sản phẩm trong giỏ hàng
        if( $p->price!=$price)
        {

            $p->price=$price;
            $p->save();
            //Trường hợp user chưa đăng nhập
            if($request->session()->get('cart'))
            {
                $cart=new Cart(session()->get('cart'));
                $cart->Adminupdate($p,$price);
                $request->session()->put('cart',$cart);
            }
            
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
            ) as T'), function ($join) 
            {
                $join->on ( 'T.order_id', '=', 'order.id' );
            })
            ->where(['order.status'=>'0'])
            ->whereNotNull('T.count')
            ->update(['total'=>DB::raw('T.count' )]);
        }
        else
        {
            $p->price=$price;
            $p->save();
        }
        $request->session()->put(['message'=>'Cập nhập thành công','alert-class'=>'alert-success']);
        return redirect()->action('AdminProductController@index');
        
    }
    public function delete(Request $request) {
        $id=$request->product_id; 
        //Không tìm thấy id thì quay về trang 404
        if($id=="")
            return abort('404');
        $p = Product::find($id);
        $p->delete();
        $request->session()->put(['message'=>'xóa thành công','alert-class'=>'alert-success']);
        //Trường hợp user chưa đăng nhập
        if($request->session()->get('cart'))
        {
            $cart=new Cart(session()->get('cart'));
            $cart->Admindelete($p);
            $request->session()->put('cart',$cart);
        }
        
        //Cập nhập tình trạng đã hết hàng của user
        $carts=order_product::join('product', 'order_product.product_id', '=', 'product.id')
        ->join('order','order_product.order_id','=','order.id')
        ->where(
        ['product.id'=>$id
        ,'order.status'=>'0']
        );
        $carts->delete();
        //Cập nhập lại tổng tiền giỏ hàng sau khí xóa sản phẩm
        $carts= DB::table('order')->setBindings([$id])
         ->leftJoin(DB::raw('(
        SELECT total-(price*qty)  AS Decreamount,order_product.order_id
        from order_product,`order`
        WHERE order_product.order_id=`order`.id AND product_id=?
        ) as T'), function ($join) {
            $join->on ( 'T.order_id', '=', 'order.id' );
        })
        ->where(['order.status'=>'0'])
        ->whereNotNull('T.Decreamount')
        ->update(['total'=>DB::raw('T.Decreamount' )]);
         return redirect()->action('AdminProductController@index');
        
       // }
    }
}

