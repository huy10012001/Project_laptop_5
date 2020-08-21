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
USE Illuminate\Database\Eloquent\Collection;
use League\CommonMark\Util\ArrayCollection;
class homeController extends Controller
{
    public function scopeWhereName($query, $queryString) {
        $chars = [' ', '.', ',','/'];
    
 
            $query=$query->selectRaw("REPLACE('name')");
           
       
       
        return $query;
        
    }
    public function index(Request $request){
       //$a="Dell-Inspiron-N3593C-i3-1005G1-4GB-256GB-15.6FHD-Win10";
        //$product=DB::table('product')->whereRaw("REPLACE(REPLACE(name,' ','-'),'/','-')= ?",$a);
        $b='Dell--';
        
       
      
        $c='MacBook Pro 16" 2019 Touch Bar 2.6GHz Core i7 512GB';
        $product_detail= Product::whereRaw(
            "REGEXP_REPLACE(name,
            '[^a-zA-Z0-9-]+',
            '-')= ?",$b)
        ->first();
        echo  $product_detail;
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
        return view('user.home');
    }

    public function checkout(){
        return view('user.contact');
    }
    public function contact(){
        return view('user.contact');
    }
    public function allproduct(Request $request)
    {
           
            $flag=false;
         //dd(count($request->all()));
          
            $all_category= DB::table('category')->select(['category.name','category.id'])->distinct()
            -> join('product','product.category_id','=','category.id')
            ->join('detail_product','detail_product.product_id','=','product.id')->
            where('product.status','1')->get();
            $product=product::where(['status'=>"1"])
            ->join('detail_product','detail_product.product_id','=','product.id');
           
           
            //Nếu tên danh mục tồn tại và ít nhất có 1 sản phẩm đã cập nhập xong chi tiết active
            if($request->price)
            {
                $flag=true;
                $prices= $_GET['price'];
                $p=[];
                $collect_product=new Collection();
               
                foreach($prices as $price)
                {
                   
                   switch($price)
                   {
                    case "dưới-10-triệu":
                      $product_record=Product::where(['status'=>"1"])
                        ->join('detail_product','detail_product.product_id','=','product.id')->where('price','<',10000000)->get();
                      
                    break;
                       
                    case "từ-10-15-triệu":
                        $product_record=Product::where(['status'=>"1"])
                        ->join('detail_product','detail_product.product_id','=','product.id')->whereBetween('price',array(10000000,15000000))->get();
                    break;
                    case "từ-15-20-triệu":
                       
                        $product_record=Product::where(['status'=>"1"])
                        ->join('detail_product','detail_product.product_id','=','product.id')->whereBetween('price',array(15000000,20000000))->get();
                    
                    break;
                        
                    case "từ-20-25-triệu":
                        $product_record=Product::where(['status'=>"1"])
                        ->join('detail_product','detail_product.product_id','=','product.id')->whereBetween('price',array(20000000,25000000))->get();
                      
                    break;
                    case "trên-25-triệu":
                        
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
               
                if(!in_array("tất-cả",$prices))
                 $product=$product->whereIn('product_id', $p);
               
            }
          
                if($request->tenhang)   
                {
    
                    $flag=true;
                    $tenhangs= $_GET['tenhang'];
                    $th=[];
                    foreach($tenhangs as $tenhang)
                    {
                        array_push($th,$tenhang);
                    }
                    if($th!=['tất-cả'])
                    {   
                        $id=[];
                        $product=$product->
                        select('product.id')->
                        join('category','product.category_id','=','category.id')
                       -> whereIn('category.name',$th)->get();
                       
                        foreach($product as $p)
                        {
                            array_push($id,$p->id);
                        }
                       
                        $product=product::whereIn('product.id',$id)->
                        where(['status'=>"1"])
                        ->join('detail_product','detail_product.product_id','=','product.id');
                      
                    }
                }   
                
               
                if($request->cpu)
                {
                    $flag=true;
                    $cpu_laptop= $_GET['cpu'];
                    $cpu_arr=[];
                    foreach($cpu_laptop as $cpu)
                    {
                            array_push($cpu_arr,$cpu);
                    }   
                    if($cpu_arr!=['tất-cả'])
                    $product=$product->whereIn('description->3', $cpu_arr);
                }
                if($request->RAM)
                {
                    $flag=true;
                    $ram_laptop= $_GET['RAM'];
                    $ram_arr=[];
                    foreach($ram_laptop as $ram)
                    {
                            array_push($ram_arr,$ram);
                    }   
                    if($ram_arr!=['tất-cả'])
                    $product=$product->whereIn('description->11', $ram_arr);
                }
                if($request->ocung)
                {
                    $flag=true;
                    $ocung_laptop= $_GET['ocung'];
                    $ocung_arr=[];
                    foreach($ocung_laptop as $ocung)
                    {
                            array_push($ocung_arr,$ocung);
                    }   
                    if($ocung_arr!=['tất-cả'])
                    $product=$product->whereIn('description->16', $ocung_arr);
                  
                }

                if($request->orderby)
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
                    }
                }
                if($request->page)
                {
                    $flag=true;
                }
                if($flag==true||count($request->all())==0)
                 {
                     $count=$product->count();
                    $product=$product->paginate(6);
                    $requestOrder=$request->orderby;
                    return view('user.product', ['count'=>$count,'requestorderby'=>$requestOrder,'all_category'=>$all_category,'product'=>$product->appends($request->except('page'))]);
                 }
                elseif(count($request->all())>0)
                {
                  //  $product=[];
                     $count=$product->count();
                    return view('user.product', ['count'=>$count,'all_category'=>$all_category]);
                }
           
    }
    public function product ($name,Request $request)
    { 
        
        
        //dd( $decoded = html_entity_decode($name) );
       
        //Tìm tên danh mục trước
        $all_category= DB::table('category')->select(['category.name','category.id'])->distinct()
        -> join('product','product.category_id','=','category.id')
        ->join('detail_product','detail_product.product_id','=','product.id')->
        where('product.status','1')->get();
        $category = category::where(['name'=>$name])->first();
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
            
            if($request->price)
            {
              
                $prices= $_GET['price'];
                $p=[];
                $collect_product=new Collection();
               
                foreach($prices as $price)
                {
                   
                   switch($price)
                   {
                    case "dưới-10-triệu":
                      $product_record=Product::where(['status'=>"1"])
                        ->join('detail_product','detail_product.product_id','=','product.id')->where('price','<',10000000)->get();
                      
                    break;
                       
                    case "từ-10-15-triệu":
                        $product_record=Product::where(['status'=>"1"])
                        ->join('detail_product','detail_product.product_id','=','product.id')->whereBetween('price',array(10000000,15000000))->get();
                    break;
                    case "từ-15-20-triệu":
                       
                        $product_record=Product::where(['status'=>"1"])
                        ->join('detail_product','detail_product.product_id','=','product.id')->whereBetween('price',array(15000000,20000000))->get();
                    
                    break;
                        
                    case "từ-20-25-triệu":
                        $product_record=Product::where(['status'=>"1"])
                        ->join('detail_product','detail_product.product_id','=','product.id')->whereBetween('price',array(20000000,25000000))->get();
                      
                    break;
                    case "trên-25-triệu":
                        
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
               
                if(!in_array("tất-cả",$prices))
                 $product=$product->whereIn('product_id', $p);
               
            }
            if($request->tenhang)   
            {

               
                $tenhangs= $_GET['tenhang'];
                $th=[];
                foreach($tenhangs as $tenhang)
                {
                    array_push($th,$tenhang);
                }
                if($th!=['tất-cả'])
                    $product=$product->join('category','product.category_id','=','category.id')
                   -> whereIn('category.name',$th);
               
            }
      
    
            if($request->cpu)
            {
                $cpu_laptop= $_GET['cpu'];
                $cpu_arr=[];
                foreach($cpu_laptop as $cpu)
                {
                        array_push($cpu_arr,$cpu);
                }   
                if($cpu_arr!=['tất-cả'])
                $product=$product->whereIn('description->3', $cpu_arr);
                
            }
           
            if($request->RAM)
            {
                $ram_laptop= $_GET['RAM'];
                $ram_arr=[];
                foreach($ram_laptop as $ram)
                {
                        array_push($ram_arr,$ram);
                }   
                if($ram_arr!=['tất-cả'])
                $product=$product->whereIn('description->11', $ram_arr);
            }
            if($request->ocung)
            {
                $ocung_laptop= $_GET['ocung'];
                $ocung_arr=[];
                foreach($ocung_laptop as $ocung)
                {
                        array_push($ocung_arr,$ocung);
                }   
                if($ocung_arr!=['tất-cả'])
                $product=$product->whereIn('description->16', $ocung_arr);
              
               
            
            }
        
            if($request->orderby)
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
                }
            }
            $count=$product->count();
             $product=$product->paginate(6);
            $requestOrder=$request->orderby;
         
            return view('user.product', ['count'=>$count,'requestorderby'=>$requestOrder,'c'=>$category,'all_category'=>$all_category,'product'=>$product->appends($request->except('page'))]);
            
        }
        else
        {
         
            //Sản phẩm active và đã cập nhập xong detail
           // $name=str_replace("-","",$name);
            $product_detail=Product::whereRaw(
             
                    "REGEXP_REPLACE(name,
                    '[^a-zA-Z0-9.\]+',
                    '-')= ?",$name)
            ->first();
           
           // $product_detail= Product::whereRaw(
              //  "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(name,' ',''),'/',''),'\"',''),'_',''),'&',''),'+',''),'-','')= ?",$name)
           // ->first();
           
          
            //$product_active=product::find($product_active_id)->first();

             //Sản phẩm không active và đã cập nhập xong detail
            if(!empty($product_detail))
            {if($product_detail->status=="1")
            {   
              
                $category=category::find($product_detail->category_id);
                $lienquan= category::join('product','product.category_id','=','category.id')
                ->join('detail_product','detail_product.product_id','=','product.id')->
                where('product.status','1')->where('category.id',$category->id);

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
    public function search(Request $request){

        $search= $request->query('keyword');
        if($search=="")
        return \abort('404');
             $product=Product::where(['status'=>"1"])
       ->join('detail_product','detail_product.product_id','=','product.id') ;
       $product = $product->where('name', 'LIKE', '%' . $search . '%');
      
       if($request->orderby)
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
                    }
                }
     
        $requestOrder=$request->orderby;
        $count=$product->count();
        $product=$product->paginate(8);
        return view('user.veview_search',['count'=>$count,'requestorderby'=>$requestOrder,'product'=>$product->appends($request->except('page')),'keyword'=>$search]);
    }


}
