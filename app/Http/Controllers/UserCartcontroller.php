<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Cart;
use Illuminate\Support\Facades\DB;
use App\order_product;
use App\Order;
use App\cart_product;
use App\Events\Qty;
use App\Product;
use Carbon\Traits\Cast;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Break_;
use PhpParser\Node\Stmt\Else_;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
use App\User;
class UserCartcontroller extends Controller

{
    public function index1()
    {

        $products = DB::table('product')->get();

        return view('index', compact('products'));
    }
 
    public function search(Request $request)
    {

    }

    public function livesearch(Request $request)
    {


           $output = '';
           if($request->search!="")
          { $products=Product::where(['status'=>"1"])
           ->join('detail_product','detail_product.product_id','=','product.id') ;
           $products = $products->where('name', 'LIKE', '%' . $request->search . '%')->get();

           if ($products) {
               $count=0;
                foreach ($products as $key => $product) {
                    $count+=1;
                    $output .= 
                    '<tr onclick="Redirectlivesearch(this)" class="search_items">
                    <td hidden class="search_name">' . $product->name . '</td> 
                    <td  style="width:50px" >
                    <img  height="50px" width="50px"  src="/images/'.$product->image.'"/>
                    </td> 
                    <td >' . $product->name .
                    '<br/>' . $product->price . "đ".'</td>
                  
                   </tr>';
              }
              $resultOuput ="";
              $resultOuput.='<tr><td colspan="2">Có khoảng '.$count.' kết quả tìm kiếm</td></tr>';
              $resultOuput.= $output;
           if($products->count()==0)
            {
                $resultOuput="<tr><td> không có kết quả bạn tìm kiếm<td></tr>";
            }
              return Response::json(array(
                'status'=> $resultOuput,
               
                
              
       )); 
    }
        }
    }
    public function postDiaChiCheckOut(Request $request)
    {
        $name=$request->name;
        $phone=$request->phone;
        $add=$request->address;
        return Response::json(array(
            'name'=>$name,
            'phone'=>$phone,
            'address'=>$add

         ));
    }
    public function cart(Request $request)
    {

        $value=$request->session()->get('key');

        //check user da dang nhap neu chua quya lai login
        if(empty($value))
        {
          //  return redirect()->action('loginController@index');

          return view('user.cart_detail');

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
                    return view('user.cart_detail')->with(['orders'=>$orders]);
                //echo $products;
               // else
                //return view('user.cart_detail');
            }
            else
            {
                return view('user.cart_detail');
            }


         }


       // return redirect()->action('Admincontroller@index');

    }
    public function index( Request $request){

        $value=$request->session()->get('key');
        return view('admin.index')->with('id',$value);
    }
    public function checkout(Request $request)
    {
        return view('checkout');
    }
    public function getOrder(Request $request)
    {
        //Nếu user thay đổi giỏ hàng thì return status ở json

            $name=$request->name;
            $phone=$request->phone;
            $add=$request->address;

            $product_update=$request->product_update;
            if($name==null || $phone==null||$add==null)
            {
                return abort('404');
            }

            $user_id= $request->session()->get('key');

            //Tìm order đang đặt của user hiện tại

            $orders=Order::where(['user_id'=>$user_id->id,'status'=>'0'])->first();

            if(empty($orders))
            {
                return Response::json(array(
                        'status'=>'giỏ hàng của bạn trống',

               ));
            }

            //chuyển trạng thái sang đã đặt hàng
            $orders_product=array();
            if(!empty($orders))
           {


                foreach($orders->product as $products)
                {
                    if($products->status=="1")

                    array_push($orders_product,$products->pivot->updated_at->toDateTimeString());

                }

                if(!empty($orders_product))
                {

                   if($product_update=="")
                   {
                    return Response::json(array(
                        'status'=> 'thay đổi'
                        ));
                   }
                    $a=array_diff($product_update,$orders_product);
                    if(!empty($a))
                        return Response::json(array(
                        'status'=> 'thay đổi'
                    ));

                }
                if(empty($orders_product))
                {

                    if($product_update!="")
                   {
                        return Response::json(array(
                        'status'=>   'thay đổi',
                        ));
                    }
                    else
                    {
                        return Response::json(array(
                            'status'=>   'giỏ hàng của bạn trống',
                            ));
                    }
                }
                order_product::where
                (['order_id'=>$orders->id ])->
                 join('product','order_product.product_id','=','product.id')
                 ->where(['product.status'=>"0"])
                 ->delete();
                $orders->name=$name;
                $orders->address=$add;

                $orders->phone=$phone;
                $orders->status="1";
                $orders->date=Carbon::now();

                $orders->save();

                $objDemo = new \stdClass();
                $objDemo->order =  $orders;
                $user=User::find($orders->user_id);
                $objDemo->user =  $user;

                 Mail::to($user->email)->send(new DemoEmail($objDemo));
                //xóa   order_product đã hết hàng trong giỏ hàng


            }





            /* if(!empty(array_diff($product_update,$orders_product)))
            return Response::json(array(
            'status'=>   'thay đổi',

            ));*/





    }
    /*   public function getUpdateCart(Request $request)
    {
        $request->session()->put('change','update');
        $order_id=$request->order_id;
        $product_id=$request->product_id;
        $c=$request->qty;

        if($product_id=="" )
                return abort('404');
        //Khi hủy session cart và chưa đăng nhập
        if(empty($order_id) && !$request->session()->has('cart'))
            {
                 return Response::json(array(
                     'status'=>'no',

            ));
        }
        if($c>10 ||$c<0 ||empty($c))
        $request->session()->put('qty','qty phải từ 0 tới 10 và không được trống');
        else
        {
            $product=Product::find($product_id);
        //tìm order trong giỏ hàng hiện tại
            if($request->session()->get('cart'))
            {
                $cart=new Cart(session()->get('cart'));
                 //nếu item không tồn tại
                if(!isset($cart->items[$product_id]))
                return Response::json(array(
                'status'=>'no',

            ));
            //Khi còn session cart nhưng user vẫn đăng nhập ở tab khác
                if(!empty($a))
                {
                return Response::json(array(
                 'status'=>'no',

                ));
                }
                $cart->update1($product,$c);
                $request->session()->put('cart',$cart);

            }

            else
            {


                 $p = order_product::where
                ([
                'order_id'=>$order_id,
                'product_id'=>$product_id

                ])->first();
             //Khi trống sản phẩm hoặc đăng nhập với id khác
                $user=Order::find($order_id)->user_id;
                if($request->session()->has('key'))
                {

                    $a=$request->session()->get('key')->id;
                    //Nếu order mới cập nhập

                }
                else
                {
                        $a=null;
                         if(empty($p)||$a!=$user )
                         return Response::json(array(
                'status'=>'no',

                 ));
                }

                order_product::where
                ([
                 'order_id'=>$order_id,
                'product_id'=>$product_id
                ])->update(['qty' => $c,'amount'=>Product::find($product_id)->price*$c]);
                //Update lại tổng giá của đơn hàng đó
                $c=Order::find($order_id);
                $c->total=order_product::where
                ([
                    'order_id'=>$order_id

                ])->sum('amount');
                 $c->save();


            }
        }
    }*/
    public function getUpdateCart(Request $request)
    {

        $order_id=$request->order_id;
        $product_id=$request->product_id;
        $c=$request->qty;
        $time_create=$request->timecreate;

        //nếu item không tồn tại


        if(($c>10 ||$c<0 ||empty($c)) )
        {
            return Response::json(array(
            'soluong'=>'1',
        ));
        }
       // $request->session()->put('change','update');
        if($product_id=="" )
                return abort('404');
       //khi giỏ hàng trống và user chưa đăng nhập hoặc khi vừa đăng nhập tab khác
        if(empty($order_id) && !$request->session()->has('key') && !$request->session()->has('cart'))
        {

                 return Response::json(array(
                     'status'=>'no1',
           ));
        }

        //đăng xuất bên tab khác và tab hiện tại vẫn mở
        if(!empty($order_id) && !$request->session()->has('key'))
            {
                 return Response::json(array
                 (
                     'status'=>'no2',

           ));
        }

        $product=Product::find($product_id);
        //tìm order trong giỏ hàng hiện tại
        if($request->session()->get('cart'))
        {

            $cart=new Cart(session()->get('cart'));
                 //nếu item không tồn tại

            if(isset($cart->items[$product_id]))
            {
                   $status=Product::find($cart->items[$product_id]['id'])->status;

            }
           if(!isset($cart->items[$product_id])||$status=="0")
            return Response::json(array(
                'status'=>'no3',

            ));


            if($time_create!=$cart->items[$product_id]['time_at'])
            return Response::json(array(
                 'status'=>'no6'
            ));

            $cart->update1($product,$c);

            $request->session()->put('cart',$cart);
            $sum=0;
            foreach($cart->items as $item)
            {
                if(!empty(Product::find($item['id']))&&Product::find($item['id'])->status=="1")
                {
                    $sum+=Product::find($item['id'])->price*$item['qty'];
                }
            }
            return Response::json(array(
                'total'=> $sum ,

            ));

        }

        if($request->session()->has('key'))
        {

            $a= $request->session()->get('key')->id;

            //Lấy id order mới hoặc id order của user khác
            if(!empty($order_id))

            {
                $user_id=Order::where(['id'=>$order_id])->first()->user_id;
                //Nếu order mới cập nhập hoặc đăng nhập với id khác
                if($user_id!=$a )
                return Response::json(array(
                'status'=>'no4' ));
            }

            //khi đăng nhập ở tab khác rồi đăng xuất và đăng nhập lại
            //Trường hợp thứ 8
            if(empty($order_id))
            {

                $order=Order::where(['user_id'=>$a,'status'=>'0'])->first();
                if(!empty($order))
                {
                    $order_id= $order->id;

                }
                $old_order_id="have";

            }
            else
            {
                $old_order_id="";
            }
            //Hết trường hợp 8
             //Khi trống sản phẩm hoặc ản phẩm không hoạt động
            $p = order_product::where
            ([
                'order_id'=>$order_id,
                'product_id'=>$product_id
            ])->first();


            if(empty($p) || Product::find($product_id)->status=="0")
                return Response::json(array(
                'status'=>'no5',
            ));
            $order_status=Order::find($order_id)->status;
            //Trường hợp 9 khi đã đặt hàng và tab hiện tại trong giỏ
            if( $order_status!=0)
            return Response::json(array(
                'status'=>'no9'
            ));
            //$time=Carbon::createFromTimestampUTC($p->created_at)->secondsSinceMidnight();
            if($old_order_id)
            {
               if(($p->created_at->timestamp+3600*7)!=$time_create )
                return Response::json(array(
                 'status'=>'no8'
                ));
            }
            if($old_order_id=="")
            {

                if($p->created_at!=\Carbon\Carbon::parse($time_create) )
                return Response::json(array(
                     'status'=>'no7'
                ));
            }

            //update order_product
             order_product::where
             ([
            'order_id'=>$order_id,
            'product_id'=>$product_id
             ])->update(['qty' => $c,'amount'=>Product::find($product_id)->price*$c]);
            //Update lại tổng giá của đơn hàng đó
            $c=Order::find($order_id);
            /*
            $c->total=order_product::where
            ([
             'order_id'=>$order_id
                ,'status'=>"1"

             ])->sum('amount');*/
             $total=order_product::where
             (['order_id'=>$order_id ])->
             join('product','order_product.product_id','=','product.id')
             ->where(['product.status'=>"1"])
             ->sum('amount');
             $c->total=$total;
             $c->save();
             return Response::json(array(
                'total'=>$c->total  ,

            ));

        }
    }

    public function delete(Request $request) {

        //$request->session()->put('change','update');
        $product_id=$request->product_id;
        $order_id=$request->order_id;
        $time_create=$request->timecreate;
        if( $product_id=="")
            return abort('404');

        $product=Product::find($product_id);
         //Khi vừa đăng nhập ở tab khác hoặc cart trống và chưa đăng nhập
        if(empty($order_id) &&  !$request->session()->has('key') && !$request->session()->has('cart'))
        {
         return Response::json(array(
             'status'=>'no1',

            ));
        }

        //khi đăng xuất ở tab khác và tab hiện tại chưa đăng xuất
        if(!empty($order_id)  && !$request->session()->has('key'))
        {
             return Response::json(array(
                 'status'=>'no2',
          ));
        }
        if($request->session()->has('cart'))
        {

            $cart=new Cart(session()->get('cart'));
            //nếu item không tồn tại
            if(!isset($cart->items[$product_id]))
                return Response::json(array(
                'status'=>'no3',

               ));

            //Trường hợp thời gian order item khác và có session cart
            if($time_create!=$cart->items[$product_id]['time_at'])
               return Response::json(array(
                    'status'=>'no6'
               ));

            $cart->delete1($product);
            $request->session()->put('cart',$cart);

            //Nếu user đã xóa hết sản phẩm trong giỏ hàng thì hủy session cart
            if(empty($cart->items))
            $request->session()->forget('cart');

            $sum=0;
            foreach($cart->items as $item)
            {

                if(!empty(Product::find($item['id']))&&Product::find($item['id'])->status=="1")
                {
                    $sum+=Product::find($item['id'])->price*$item['qty'];
                }
            }
            return Response::json(array(
                'total'=> $sum ,

            ));
        }

        if($request->session()->has('key'))
        {

            $a=  $request->session()->get('key')->id;
            //Lấy id order mới hoặc id order của user khác
           // $new_order=Order::where(['user_id'=>$a,'status'=>'0'])->first();



           if(!empty($order_id))
            {

               $user_id=Order::where(['id'=>$order_id])->first()->user_id;
               //Nếu order mới cập nhập hoặc đăng nhập với id khác
               if($user_id!=$a )
               return Response::json(array(
               'status'=>'no4' ));

            }

            //Khi sản phẩm cũ bị trống
            if(empty($order_id))
            {
                $order=Order::where(['user_id'=>$a,'status'=>'0'])->first();
                if(!empty($order))
                {
                    $order_id= $order->id;

                }
                $old_order_id="have";
            }
            else
            {
                $old_order_id="";
            }
            $p = order_product::where
            ([
                'order_id'=>$order_id,
                'product_id'=>$product_id

            ])->first();
             //Khi trống sản phẩm

            if(empty($p))
                return Response::json(array(
                'status'=>'no5',
                ));
            $order_status=Order::find($order_id)->status;
            //Trường hợp 9 khi đã đặt hàng và tab hiện tại trong giỏ
             if( $order_status!=0)
            return Response::json(array(
                    'status'=>'no9'
             ));

            if($old_order_id)
            {
                if(($p->created_at->timestamp+3600*7)!=$time_create )
                return Response::json(array(
                     'status'=>'no8'
                    ));
            }
            if($old_order_id=="")
            {
                if($p->created_at!=\Carbon\Carbon::parse($time_create) )
                return Response::json(array(
                         'status'=>'no7'
                ));
            }
            $c=Order::where(['id'=>$order_id,'status'=>"0"])->first();

            //sản phẩm chưa hết hàng hoặc còn hoạt động thì trừ đi giá sản phẩm đó
           /* if($p->status=="1")
            {
                $c->total=$c->total-$p->amount;

                $c->save();

            }
          */
          if(Product::find($p->product_id)->status=="1")
          { $c->total=$c->total-$p->amount;

          $c->save();

            }

                 //Xóa order trong giỏ hàng hiện tại
            $order_product= order_product::where
            ([
                'order_id'=>$order_id,
                'product_id'=>$product_id
            ])->delete();

            return Response::json(array(
                    'total'=>$c->total  ,

                ));
        }


    }
    public function addCart(Request $request){

       //  $request->session()->put('change','update');
        $id=$request->product_id;
        if($id=="")
            return abort('404');
        $product=Product::find($id);

        $user= $request->session()->get('key');

       if(empty($user))
        {
            if($request->session()->get('cart'))
            {
                $cart=new Cart(session()->get('cart'));

            }

            else
            {
               $cart=new Cart();

            }

            if(isset($cart->items[$id]))
            {
                if($cart->items[$id]['qty']<10 )
                {
                    $cart->add($product);
                }
                 else
               {
                 return Response::json(array(
                    'status'=>'error',
                     'message'   => 'Số lượng sản phẩm trong giỏ hàng lớn hơn 10'
                   ));
               }
             }

            else
            {
                //Thời gian tạo sản phẩm order mới session

                 $cart->add($product);
            }
                $request->session()->put('cart',$cart);

              //dd($cart);


        }
        else
        {
            $user_id=$user->id;

       //Kiểm tra xem user_id có tồn tại trong database giỏ hàng

        $carts=Order::where(['user_id'=>$user_id,'status'=>'0'])->first();
        //nếu không tìm được giỏ hàng chứa id đó thì tạo order mới
       if(empty($carts))
        {
            $carts=new Order();
            $carts->user_id=$user_id;
            $carts->total=0;
            $carts->status="0";
            $carts->date=Carbon::now();
            $carts->name=$user->name;
            $carts->address=$user->address;
            $carts->phone=$user->phone;
            $carts->save();
        }
         //kiem tra san pham vua them da nam trong cart chua
         $order_product=order_product::where([
            'order_id'=>$carts->id,
            'product_id'=>$id

        ])->first();

        if(empty($order_product))
        {
            $order_product=new order_product();
            $order_product->order_id=$carts->id;
            $order_product->product_id=$id;

            $order_product->price=Product::find($id)->price;

            $order_product->qty=1;
            $order_product->amount=$order_product->price;

            $order_product->save();
            $carts->total=$carts->total+=Product::find($id)->price;
            $carts->save();
        }

        //neu da co san pham thi tagn qty len 1,nếu số lượng lớn hơn 10 thì thông báo lỗi
        elseif($order_product->qty>9)
        {
            return Response::json(array(
                'status'=>'error',
                 'message'   => 'Số lượng sản phẩm trong giỏ hàng lớn hơn 10'
               ));
        }
        else
        {
            $order_product::where
            ([
                'order_id'=>$carts->id,
                'product_id'=>$id
            ])->update(['qty'=> $order_product->qty+1,'amount'=>Product::find($id)->price*($order_product->qty+1)]);
             $order_product->save();
            $carts->total=$carts->total+=Product::find($id)->price;
            $carts->save();
        }
       }
    }
}
