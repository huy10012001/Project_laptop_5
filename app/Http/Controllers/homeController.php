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
use App\Http\Requests\ContactRequest;
use App\Http\Requests\ProductRequest;
use App\order_product;
use Facade\FlareClient\Api;
USE Illuminate\Database\Eloquent\Collection;
use League\CommonMark\Util\ArrayCollection;
use Cviebrock\EloquentSluggable\Services\SlugService;


class homeController extends Controller
{
    
    public function filter($filter_request,$string_request_filter,$product,$query)
    {
        
      
        $flag=false;
        //conver chuỗi giá trị lọc và request  nhận từ url
        //chuỗi từ url
        $filter_request=  explode(',',$filter_request);
        //chuỗi lọc
        $string_request_filter= explode(',',$string_request_filter);
      
        $request_arr=[];
        foreach($filter_request as $f_request)
        {
            //viết thường
            $f_request=strtolower($f_request);
            //nếu giá trị đó có trong chuỗi cần filter
            if(in_array($f_request,$string_request_filter))
            { 
                $flag=true;
                $f_request=str_replace('-',' ', $f_request);
                array_push($request_arr, $f_request);

            }
        }
       
        //nếu value request từ url nằm trong value chuỗi giá trị lọc
        if($flag==true)
        {   
            $product=$product->whereIn("description->".$query,  $request_arr);
            return $product;
        }
        else
            return "";
        
    }
    public function allproduct(Request $request)
    {
           
        $flag=false;
         //dd(count($request->all()));
        $all_category= DB::table('category')->select(['category.name','category.slug','category.id'])->distinct()
        -> join('product','product.category_id','=','category.id')
        ->join('detail_product','detail_product.product_id','=','product.id')->
        where('product.status','1')->get();
        $product=product::where(['status'=>"1"])
        ->join('detail_product','detail_product.product_id','=','product.id');
           
           
      
        if(is_string($request->price))
        { 
                $prices= explode(',',$request->price);
               
                $p=[];
                $collect_product=new Collection();
                foreach($prices as $price)
                {
                    $price=strtolower($price);
                switch($price)
                {
                    case "duoi-10-trieu":
                        $product_record=Product::where(['status'=>"1"])
                            ->join('detail_product','detail_product.product_id','=','product.id')->where('price','<',10000000)->get();
                         break;
                        
                    case "tu-10-15-trieu":
                            $product_record=Product::where(['status'=>"1"])
                            ->join('detail_product','detail_product.product_id','=','product.id')->whereBetween('price',array(10000000,15000000))->get();
                        break;
                    case "tu-15-20-trieu":
                        
                        $product_record=Product::where(['status'=>"1"])
                            ->join('detail_product','detail_product.product_id','=','product.id')->whereBetween('price',array(15000000,20000000))->get();
                        break;
                    case "tu-20-25-trieu":
                        $product_record=Product::where(['status'=>"1"])
                        ->join('detail_product','detail_product.product_id','=','product.id')->whereBetween('price',array(20000000,25000000))->get();
                        break;
                    case "tren-25-trieu":
                         $product_record=Product::where(['status'=>"1"])
                            ->join('detail_product','detail_product.product_id','=','product.id')->where('price','>',25000000)->get();
                        break;
                  
                }
                if(isset($product_record))
                        $collect_product=$collect_product->merge($product_record);
                }
         
                foreach($collect_product as $c_p)
                {

                    array_push($p,$c_p->product_id);
                }
              
                foreach($prices  as $value)
                 {   
                  
                     //nếu request từ url lớn hơn 1 honặc  giá trị url có trong chuỗi filter
                    $value=strtolower($value);
                   
                    if($value=='duoi-10-trieu'||$value=='tu-10-15-trieu'||$value=='tu-15-20-trieu'
                    ||$value=='tu-20-25-trieu'||$value=='tren-25-trieu')
                    {
                        $flag=true;
                        $product=$product->whereIn('product_id', $p);
                    }
                }
                
                  
        }
      
        if(is_string($request->input('ten-hang')))
        {   
            $flag=true;
            $tenhangs= explode(',',$request->input('ten-hang'));
            $th=[];
            foreach($tenhangs as $tenhang)
            {
                array_push($th,$tenhang);
            }
        
                $id=[];
                $product=$product->
                select('product.id')->
                join('category','product.category_id','=','category.id')
                -> whereIn('category.slug',$th)->get();
                       
                foreach($product as $p)
                {
                    array_push($id,$p->id);
                }
                $product=product::whereIn('product.id',$id)->
                where(['status'=>"1"])  
                ->join('detail_product','detail_product.product_id','=','product.id');
                      
                
        }   
     
     
        if(is_string($request->cpu))
        { 
            
            $key_description=3;
            $string_request_filter="celeron,pentium,core-i3,core-i5,core-i7,core-i9,ryzen-3,ryzen-5,ryzen-7";
            if($this->filter($request->cpu,$string_request_filter,$product,$key_description)!="")
            {
                $flag=true;
                $product=$this->filter($request->cpu,$string_request_filter,$product,$key_description);
            }
          
        }
       
       
        if(is_string($request->RAM))
        {
        
            $key_description=11;
            $string_request_filter="4-gb,8-gb,16-gb,32-gb";
            if($this->filter($request->RAM,$string_request_filter,$product,$key_description)!="")
            {

                $flag=true;
                $product=$this->filter($request->RAM,$string_request_filter,$product,$key_description);
            }
       }
        if(is_string($request->ocung))
        {
           
            $key_description=16;
            $string_request_filter="1-tb,512-gb,256-gb,128-gb";
            if($this->filter($request->ocung,$string_request_filter,$product,$key_description)!="")
            {
                $flag=true;
                $product=$this->filter($request->ocung,$string_request_filter,$product,$key_description);
            }
              
        }
       
        $orderBy="";
        if(is_string($request->orderby))
        {
            if(count($request->all())=="1")
                $flag=true;
        
            $orderBy=$request->orderby;
            switch($orderBy)
            {
                case 'asc':
                    $product=$product->orderBy('price', 'asc');
                    break;
                case 'desc':
                    $product=$product->orderBy('price', 'desc');
                    break;   
                case 'new':
                    $product=$product->orderBy('product_id', 'desc');
                    break;    
                default:    
                    $product=$product->orderBy('product_id', 'desc');
                    break;    
            }
           
        }
     
        //nếu không có  request sắp xếp thì mặc định sẽ mới nhất
        if(!is_string($request->orderby))
        {
        
            $product=$product->orderBy('product_id', 'desc');
        }
     
        if($request->page)
        {
            $flag=true;
        }
     
        if($flag==true ||count($request->all())==0)
        {
           
            $count=$product->count();
            $product=$product->paginate(6);
           
            
            return view('user.product', ['count'=>$count,'requestorderby'=> $orderBy,'all_category'=>$all_category,'product'=>$product->appends($request->except('page'))]);
        }
        elseif(count($request->all())>0)
        {
            return view('user.product', ['all_category'=>$all_category]);
        }
           
    }
    public function product ($slug,Request $request)
    { 
        //Tìm tên danh mục trước
        $all_category= DB::table('category')->select(['category.name','category.slug','category.id'])->distinct()
        -> join('product','product.category_id','=','category.id')
        ->join('detail_product','detail_product.product_id','=','product.id')->
        where('product.status','1')->get();
        $category = category::where(['slug'=>$slug])->first();
        $product=Product::where(['status'=>"1"])
        ->join('detail_product','detail_product.product_id','=','product.id') ;
        if(!empty($category))
        { 
            $product=Product::where(['category_id'=>$category->id,'status'=>"1"])
            ->join('detail_product','detail_product.product_id','=','product.id') ;
      
        }
       //Nếu tên danh mục tồn tại và ít nhất có 1 sản phẩm đã cập nhập xong chi tiết active
        if(!empty($category)&&$product->count()>0)
        {       
            if(is_string($request->price))
            { 
                    $prices= explode(',',$request->price);
                   
                    $p=[];
                    $collect_product=new Collection();
                    foreach($prices as $price)
                    {
                        $price=strtolower($price);
                    switch($price)
                    {
                        case "duoi-10-trieu":
                            $product_record=Product::where(['status'=>"1"])
                                ->join('detail_product','detail_product.product_id','=','product.id')->where('price','<',10000000)->get();
                             break;
                            
                        case "tu-10-15-trieu":
                                $product_record=Product::where(['status'=>"1"])
                                ->join('detail_product','detail_product.product_id','=','product.id')->whereBetween('price',array(10000000,15000000))->get();
                            break;
                        case "tu-15-20-trieu":
                            
                            $product_record=Product::where(['status'=>"1"])
                                ->join('detail_product','detail_product.product_id','=','product.id')->whereBetween('price',array(15000000,20000000))->get();
                            break;
                        case "tu-20-25-trieu":
                            $product_record=Product::where(['status'=>"1"])
                            ->join('detail_product','detail_product.product_id','=','product.id')->whereBetween('price',array(20000000,25000000))->get();
                            break;
                        case "tren-25-trieu":
                             $product_record=Product::where(['status'=>"1"])
                                ->join('detail_product','detail_product.product_id','=','product.id')->where('price','>',25000000)->get();
                            break;
                      
                    }
                    if(isset($product_record))
                            $collect_product=$collect_product->merge($product_record);
                    }
             
                    foreach($collect_product as $c_p)
                    {
    
                        array_push($p,$c_p->product_id);
                    }
                  
                    foreach($prices  as $value)
                     {   
                      
                         //nếu request từ url lớn hơn 1 honặc  giá trị url có trong chuỗi filter
                        $value=strtolower($value);
                       
                        if($value=='duoi-10-trieu'||$value=='tu-10-15-trieu'||$value=='tu-15-20-trieu'
                        ||$value=='tu-20-25-trieu'||$value=='tren-25-trieu')
                        {
                            $flag=true;
                            $product=$product->whereIn('product_id', $p);
                        }
                    }
                    
                      
            }
            if(is_string($request->cpu))
            {
                $key_description=3;
                $string_request_filter="celeron,pentium,core-i3,core-i5,core-i7,core-i9,ryzen-3,ryzen-5,ryzen-7";
                if($this->filter($request->cpu,$string_request_filter,$product,$key_description)!="")
                {
                    
                    $product=$this->filter($request->cpu,$string_request_filter,$product,$key_description);
                }
                
            }
           
            if(is_string($request->RAM))
            {
            
                $key_description=11;
                $string_request_filter="4-gb,8-gb,16-gb,32-gb";
                if($this->filter($request->RAM,$string_request_filter,$product,$key_description)!="")
                {
    
                    $flag=true;
                    $product=$this->filter($request->RAM,$string_request_filter,$product,$key_description);
                }
           }
            if(is_string($request->ocung))
            {
               
                $key_description=16;
                $string_request_filter="1-tb,512-gb,256-gb,128-gb";
                if($this->filter($request->ocung,$string_request_filter,$product,$key_description)!="")
                {
                    $flag=true;
                    $product=$this->filter($request->ocung,$string_request_filter,$product,$key_description);
                }
                  
            }
           
            $orderBy="";
            if(is_string($request->orderby))
            {
                $flag=true;
                $orderBy=$request->orderby;
                switch($orderBy)
                {
                    case 'asc':
                        $product=$product->orderBy('price', 'asc');
                        break;
                    case 'desc':
                        $product=$product->orderBy('price', 'desc');
                        break;   
                    case 'new':
                        $product=$product->orderBy('product_id', 'desc');
                        break; 
                        default:    
                        $product=$product->orderBy('product_id', 'desc');
                        break;         
                }
              
            }
          
         
            if(!is_string($request->orderby))
                $product=$product->orderBy('product_id', 'desc');
            $count=$product->count();
            $product=$product->paginate(6);
         
            return view('user.product', ['count'=>$count,'requestorderby'=>$orderBy,'c'=>$category,'all_category'=>$all_category,'product'=>$product->appends($request->except('page'))]);
            
        }
        else
        {
            //$product_detail=Product::whereRaw(
                   // "REGEXP_REPLACE($sql,
                    //'[^a-zA-Z0-9.\]+',
                  //  '-')= ?",$name)
           // ->first();
          // dd($product_detail);
          $product_detail=Product::where(['slug'=>$slug])->first();
           if(!empty($product_detail))
            {
                if($product_detail->status=="1")
                {   
                    $category=category::find($product_detail->category_id);
                    $lienquan= category::join('product','product.category_id','=','category.id')
                    ->join('detail_product','detail_product.product_id','=','product.id')->
                    where('product.status','1')->where('category.id',$category->id);


                        //
                   
                   return view('detail')->with(['p'=>$product_detail,'c'=>$category,'lq'=>$lienquan]);
                }
                else  if($product_detail->status=="0")
                     return view('detail')->with(['noactive'=>$product_detail]);
            }
            else
            {
                    return \abort('404');
            }
        }
    }
    
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
    public function index(Request $request){
       
       //lấy id các danh mục có ít nhất 1 sản phẩm hoạt động và đã cập nhập chi tiết
      
       $category=category::all();
      // $category=$category->paginate(5);
      // $category=$category-> product()->paginate(5);
     return view('index',['category'=>$category]);
      
      //  $c='MacBook Pro 16" 2019 Touch Bar 2.6GHz Core i7 512GB';
       // $product_detail= Product::whereRaw(
           // "REGEXP_REPLACE(name,
           // '[^a-zA-Z0-9-]+',
          //  '-')= ?",$b)
       //// ->first();
        //echo  $product_detail;
        //$product=Product::find($product->id);
     //  echo $product_detail;
        // $product=product::find($product_id);
        //return view('index')->with(['p'=>$product]);
        // $product=DB::table('product')->whereRaw("REPLACE(name,'\'\'','')= ?",$b);
      //  $product=Product::all();
        //$product=$this->scopeWhereName(DB::table('product'),$b);
     
      // $productLoc=Product::selectRaw();
       // $product=DB::table('product')->whereRaw("name = ?",[$b]);
    //$product=DB::table('product')->whereRaw("REPLACE(name,Substring(name, PatIndex('%[/]%', name),1),'') = ?",$b);
  
   //$productLoc=DB::table('product')-> whereRaw("REPLACE(name,Substring(name, PatIndex('%[^0-9.-]%', name), 1), '-') = ?",$a);
    // return view('index');
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
        $all_category_id= category::select('category.id')->distinct()
        ->join('product','product.category_id','=','category.id')
        ->join('detail_product','detail_product.product_id','=','product.id')->
        where('product.status','1')->get();
        $all_category= category::find( $all_category_id);
        $new_product=Product::join('detail_product','detail_product.product_id','=','product.id')->
        where('product.status','1')->orderBy('product_id', 'desc')->take(6)->get();
        $sale_product=Product::join('detail_product','detail_product.product_id','=','product.id')->
        where('product.status','1')->orderBy('price', 'asc')->take(6)->get();
        return view('user.home', ['sale_product'=>$sale_product,'all_category'=>$all_category,'new_product'=> $new_product]);
 
    }

    public function checkout(){
        return view('user.contact');
    }
    public function contact(){
        return view('user.contact');
    }
   


    public function postContact(ContactRequest $request)
    {
        $contact=$request->all();
        $c = new contact_user($contact);
       
        $c->save();
        

    }
    public function search(Request $request){

        $search= $request->query('keyword');
        if($search=="")
        return \abort('404');
             $product=Product::where(['status'=>"1"])
       ->join('detail_product','detail_product.product_id','=','product.id') ;
       $product = $product->where('name', 'LIKE', '%' . $search . '%');
      
       $orderBy="";
       if(is_string($request->orderby))
        {
       
            $orderBy=$request->orderby;
             switch($orderBy)
                    {
                        
                        case 'asc':
                            $product=$product->orderBy('price', 'asc');
                            break;
                         case 'desc':
                            $product=$product->orderBy('price', 'desc');
                            break;  
                        case 'new':
                                $product=$product->orderBy('product_id', 'desc');
                              
                            break;    
                        default:    
                            $product=$product->orderBy('product_id', 'desc');
                            break;   
                    }
        }
       
        if(!is_string($request->orderby))
        {
           
            $product=$product->orderBy('product_id', 'desc');
        }
       
        $count=$product->count();
        $product=$product->paginate(8);
        return view('user.veview_search',['count'=>$count,'requestorderby'=> $orderBy,'product'=>$product->appends($request->except('page')),'keyword'=>$search]);
    }


}
