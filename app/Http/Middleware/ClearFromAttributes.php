<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use App\category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\URL;
class ClearFromAttributes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
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
    public function urlSlug($value)
    {
      
       
            $url_slug=[];
           
            foreach($value as $val)
            {
                if($val!="tất-cả")
                array_push($url_slug,$this->convert_name($val));
            }
            $url_slug=implode(",",$url_slug);
            return $url_slug;
      
  
      
    }
    public function handle($request, Closure $next)
    {
       
        
        $fullurl_redirect="";
         
        foreach($request->except('_token') as $key=> $value)
        {   
         
            if(is_array($value)  && ($key=="price" || $key=="cpu" ||$key=="RAM"||$key=="ocung"))
            //nếu value này dạng mảng   
            {
            
                $value=$this->urlSlug($value);
                if($value!="")
                    $fullurl_redirect.=$key."=".$value."&";
                
            }   
        }
        
      
        $fullurl_redirect=substr($fullurl_redirect, 0, -1);
      
          
    
        //$fullurl_redirect=substr($fullurl_redirect, 0, -1);
     
        //  dd(url()->current()."?".$fullurl_redirect);
       //$url_WithPage=url()->current().'?'.(http_build_query($request->all()));
        //dd(URL::full());
    
        if(is_string($request->orderby)&&($request->orderby=="new"||$request->orderby=="asc"||$request->orderby=="desc"))
        {   
         
            if($fullurl_redirect!="")
                $fullurl_redirect.="&"."orderby=".$request->orderby;
            else
                $fullurl_redirect.="orderby=".$request->orderby;
             
        }
        if(is_string($request->page))
        {
            if($fullurl_redirect!="")
            $fullurl_redirect.="&"."page=".$request->orderby;
            else
            $fullurl_redirect.="page=".$request->orderby;
        }
        if(is_array($request->tenhang))
        {  
           
            //$fullurl_redirect.=$r;
             $tenhang= $_GET['tenhang'];
               
            //$a=url()->current().'?'.(http_build_query($request->except('tenhang')));
               
            if(in_array("tất-cả",$tenhang))
            {
                if($fullurl_redirect!="")
                    return redirect()->to('product'."?".$fullurl_redirect);
                else
                    return redirect()->to('product');
            }
            else if(count($request->tenhang)=="1")
            {
                   
                if($fullurl_redirect!="")
                    return redirect()->to('product/'. implode($tenhang).'?'.$fullurl_redirect);
                 else
                    return redirect()->to('product/'.implode($tenhang));
                   
            }
            else

            {
                
                $value=$this->urlSlug($request->tenhang);
           
                if($fullurl_redirect!="")
                    $fullurl_redirect="?ten-hang=".$value."&".$fullurl_redirect;
                else
                    $fullurl_redirect="?ten-hang=".$value;
                return redirect()->to('product/'.$fullurl_redirect);
            }
              
        } 
            
            
               
        
        return $next($request);
    }
     
}
