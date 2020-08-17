<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\category;
use App\contact_user;
use App\DetailProduct;
use App\Order;
use App\product;
use App\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
USE Illuminate\Support\Facades\Redirect;
use App\Mail\DemoEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use App\Cart;
use App\order_product;

class homeController extends Controller
{
    public function detail(Request $request){

        return view('detail');
    }
    public function index(Request $request){

        $request->session()->forget('cart');


       $category= category::join('product','product.category_id','=','category.id')
       ->join('detail_product','detail_product.product_id','=','product.id')->
      where('product.status','1');
       echo $category->get();
   //  $request->session()->forget('cart');
    }

    public function order(Request $request){

        //$request->session()->flush();
        //$request->session()->forget('change');
        $value=$request->session()->get('key');

        //check user da dang nhap neu chua quya lai login
        if(empty($value))
        {


           //lấy url trang trước
            return view('user.order');
        }
        else
        {
            $user_id=$value->id;
            //lấy giỏ hàng của user_id
            $orders=Order::where(['user_id'=>$user_id,'status'=>'0'])->first();

            if(!empty($orders))
            {

              // $products=Order::find($orders->id)->product;
               //nếu có sản phẩm khi show sản phẩm trong giỏ hàng của user
               /// if(count($products)>0)
                    return view('user.order')->with(['orders'=>$orders]);
                //echo $products;
               // else
                //return view('user.cart_detail');
            }
            else
            {
                return view('user.order');
            }


         }
    }
    public function home(Request $request){

        //$request->session()->flush();
        return view('user.home');
    }

    public function checkout(){
        return view('user.contact');
    }
    public function contact(){
        return view('user.contact');
    }

    public function product ($name,Request $request)
    {
        $name=str_replace("-", " ", $name);
        //Tìm tên danh mục trước
        $category = category::where(['name'=>$name])->first();

        if(!empty($category))
        {
               $product=Product::where(['category_id'=>$category->id,'status'=>"1"])
            ->join('detail_product','detail_product.product_id','=','product.id') ;

        }
       //Nếu tên danh mục tồn tại và ít nhất có 1 sản phẩm đã cập nhập xong chi tiết active
        if(!empty($category)&&$product->count()>0)
        {

            if($request->price)
            {
               $price=$request->price;
               switch($price)
               {
                   case'1':
                     $product=$product->where('price','>=',1000000);
                   break;
                   case'2':
                    $product=$product->where('price','>=',3000000);
                  break;
                  case'3':
                    $product=$product->where('price','>=',5000000);
                  break;
               }
            }
            if($request->boxuly)
            {
                $boxuly=$request->boxuly;
                switch($boxuly)
                {
                    case'80':
                        //$a= j;
                        $product=$product->whereRaw('JSON_VALUE(description,"$.2")=80');

                      break;
                      case'40':
                       $product=$product->where('price','>=',3000000);
                     break;

                }
            }
            if($request->order)
            {
                $orders=$request->order;
                switch($orders)
                {
                    case 'desc':
                        $product=$product->orderBy('price','DESC');
                    break;
                    case 'asc':
                            $product=$product->orderBy('price','ASC');
                    break;
                }
            }
            $product=$product->paginate(6);
            return view('user.product', ['c'=>$category,'product'=>$product]);
        }
        else
        {
            //Sản phẩm active và đã cập nhập xong detail
            $product_active_id=Product::where(['name'=>$name,'status'=>"1"])
           -> join('detail_product','detail_product.product_id','=','product.id')->
            select('product.id')->get();
            $product_active=product::find($product_active_id)->first();

             //Sản phẩm không active và đã cập nhập xong detail
            $product_noactive_id=Product::where(['name'=>$name,'status'=>"0"])
            -> join('detail_product','detail_product.product_id','=','product.id')->
             select('product.id')->get();
             $product_noactive=product::find($product_noactive_id)->first(); ;
            if(!empty($product_active))
            {

                $category=category::find($product_active->category_id);
                $lienquan= category::join('product','product.category_id','=','category.id')
                ->join('detail_product','detail_product.product_id','=','product.id')->
                where('product.status','1')->where('category.id',$category->id);

                return view('detail')->with(['p'=>$product_active,'c'=>$category,'lq'=>$lienquan]);

            }
            else  if(!empty($product_noactive))
                  return view('detail')->with(['noactive'=>$product_noactive]);
            else
            {
                return \abort('404');
            }
        }

    }


    public function postContact(Request $request)
    {
        $name = $request->input('ct_name');
        $email = $request->input('ct_email');
        $phone = $request->input('ct_phone');
        $title = $request->input('ct_title');
        $mess=$request->input('ct_message');
         $c = new contact_user();
         $c->name=$name;
         $c->email=$email;
         $c->phone=$phone;
         $c->subject=$title;
         $c->message=$mess;
         $c->save();
         return Redirect::Back();

    }
    public function search(){
        return view('user.veview_search');
    }


}
