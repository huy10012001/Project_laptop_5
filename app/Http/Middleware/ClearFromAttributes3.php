<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use App\category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cocur\Slugify\Slugify;
class ClearFromAttributes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
  
    public function handle($request, Closure $next)
    {
       
        
        if ($request->orderby=="default") {
          // array_push($expect,$request->orderby);
           
          if(count($request->all())=="1")
          return redirect()->to(url()->current());
            else
            return redirect()->to(url()->current().'?'.(http_build_query($request->except("orderby"))));
        }
      
      
        if(is_array($request->price))
        {  
          
            $price= $_GET['price'];
            //$request->price="gia-ca=".$this->urlSlug( $request->price);
            if(in_array("tất-cả",$price))
            {
               // array_push($expect,$request->price);
                return redirect()->to(url()->current().'?'.(http_build_query($request->except("price"))));
            }
        
           
        } 
       
        if(is_array($request->cpu))
        {  
           
            $cpu= $_GET['cpu'];
            //$request->cpu="cpu=".$this->urlSlug( $request->cpu);
            if(in_array("tất-cả",$cpu))
            {
                 //array_push($expect,$request->cpu);
               return redirect()->to(url()->current().'?'.(http_build_query($request->except("cpu"))));
            }
               
            
        } 
        if(is_array($request->RAM))
        {  
           
            $ram= $_GET['RAM'];
            if(in_array("tất-cả",$ram))
            {   
                 //array_push($expect,$request->RAM);
               return redirect()->to(url()->current().'?'.(http_build_query($request->except("RAM"))));
            }
        } 
        if(is_array($request->ocung))
        {  
          
            $ocung= $_GET['ocung'];
           
            if(in_array("tất-cả",$ocung))
            {    
                 //array_push($expect,$request->ocung);
                return redirect()->to(url()->current().'?'.(http_build_query($request->except("ocung"))));
            
            }
        } 
        if(is_array($request->tenhang))
        {  
          
           
            $tenhang= $_GET['tenhang'];
               
            $a=url()->current().'?'.(http_build_query($request->except('tenhang')));
               
            if(in_array("tất-cả",$tenhang))
            {
                if(count($request->all())!="1")
                     return redirect()->to($a);
                else
                    return redirect()->to('product');
            }
            else if(count($request->tenhang)=="1")
            {
                   
                if(count($request->all())>1)
                    return redirect()->to('product/'. implode($tenhang).'?'.(http_build_query($request->except("tenhang"))));
                 else
                    return redirect()->to('product/'.implode($tenhang));
                   
            }
                /*
                else
                {   
                    $url_tenhang=[];
                    foreach($tenhang as $th)
                    {
                        array_push($url_tenhang,$th);
                    }
                    $url_redirect="ten-hang=".implode("&",$url_tenhang);
                    if(count($request->all())>1)
                    return redirect()->to('product/'. $url_redirect.'?'.(http_build_query($request->except("tenhang"))));
                    else
                    return redirect()->to('product/'. $url_redirect);
                }*/
              
        } 
            
            
               
        
        return $next($request);
    }
     
}
