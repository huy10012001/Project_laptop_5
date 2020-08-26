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
use App\DetailProduct;
 use \Cviebrock\EloquentSluggable\Services\SlugService;
use League\CommonMark\Normalizer\SlugNormalizer;

class AdminProductController extends Controller
{   
    public function convert_name($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\/|\"|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
        $str = preg_replace("/( )/", '-', $str);
        $str = preg_replace('/-+/', '-', $str);
        return $str;
    }
    public function postDetailProduct(Request $request)
    {
        $d1=$request->except('_token','product');
        $d2=json_encode($d1);
        $product=$request->input('product');
        $detail_products=DetailProduct::where(['product_id'=>$product])->first();
        if(empty($detail_products))
        $detail_products=new DetailProduct();
        $detail_products->product_id=$product;
        $detail_products->description=$d2;
        $detail_products->save();
        return Response::json(array(
            'name'=>$d2
            
          
         )); 
    }
    public function DetailProduct($id,Request $request)
    { 
        $products = Product::find($id);
        if(empty($products))
        
           return \abort('404');
         $user=$request->session()->get('key');
            if(!empty($user))
        $user=User::find($user->id);
        
        if (!empty($user)&& $user->can('do')) {
            $detail_products=DetailProduct::where(['product_id'=>$id])->first(); 
          return view('admin.product.detail')->with(['p'=>$products,'detail'=>$detail_products]);
        }
        else
        return \abort('403');
       
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
        $p->slug=SlugService::createSlug(Product::class,'slug',$request->name);
       // $p->slug=$this->convert_name($request->input('name'));
        $p->image=$imageName;
        $p->status="1";
        $p->save();
        $request->session()->put(['message'=>'Thêm mới thành công','alert-class'=>'alert-success']);
        return redirect()->action('AdminProductController@index');
    }
    public function update($id,Request $request)
    {
     
        $p=Product::find($id);
   
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
        $status= $_POST['status'];
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
        if($p->name!=$name)
        {
            $p->name=$name;
            $p->slug=SlugService::createSlug(Product::class,'slug',$request->name);
        }
        $p->category_id=$category;
        $p->image = $imageName;
        
        //update lại status
       
        //update lại tổng  giá sản phẩm trong giỏ hàng
        if( $p->price!=$price||$p->status!=$status)
        { 
            $p->status=$status;
            $p->price=$price;
            $p->save();
            
            $orders=Order::where(['status'=>'0'])->get();
            foreach($orders as $order)
            {
                foreach($order->product as $o_product)
                {   
                    if( $o_product->pivot->product_id==$id)
                   
                        $o_product->pivot->update(['price'=>$price,'amount'=>$price* $o_product->pivot->qty]);

                }
            }
            $cart_users=Order::where(['status'=>"0"])->get();
            foreach($cart_users as $cart_user)
            {
          
                $total=order_product::where(['order_id'=>$cart_user->id])
                ->join('product','order_product.product_id','=','product.id')
                ->where(['product.status'=>"1"])
                ->sum('amount');
                Order::where(['status'=>"0",'id'=>$cart_user->id])->update(['total'=>$total]);
            }
            //Trường hợp user chưa đăng nhập
            /*
            
            order_product::join('product', 'order_product.product_id', '=', 'product.id')
            ->join('order','order_product.order_id','=','order.id')
            ->where(
                ['product.id'=>$id
                ,'order.status'=>'0']
            )
            ->update(['order_product.status' => Product::find($id)->status,'order_product.price' => Product::find($id)->price,'order_product.amount'=>DB::raw('product.price*order_product.qty' )]);
            //update lại tổng thành tiền
            $cart_users=Order::where(['status'=>"0"])->get();
            foreach($cart_users as $cart_user)
            {
                $total=order_product::where(['status'=>"1",'order_id'=>$cart_user->id])->sum('amount');
                Order::where(['status'=>"0",'id'=>$cart_user->id])->update(['total'=>$total]);
            }*/
        }
        else
        {
            $p->status=$status;
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
        $order=order_product::where(['product_id'=>$p->id])->first();
        if(!empty($order))
        { 
            $request->session()->put(['message'=>'không thể xóa sản phẩm này','alert-class'=>'alert-danger']);
           
        }
        else
        {
        $p->delete();
        $request->session()->put(['message'=>'xóa thành công','alert-class'=>'alert-success']);
        }
        //Trường hợp user chưa đăng nhập
        
    }
}

