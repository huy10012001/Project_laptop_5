<?php

namespace App\Http\Middleware;

use Closure;

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
           
            return redirect()->to(url()->current().'?'.http_build_query($request->except("orderby")));
        }
       
        if(isset($_GET['price'])&& is_array($_GET['price']))
        {  
          
            $price= $_GET['price'];
            if($price[0]=="tất-cả")
            {
               // array_push($expect,$request->price);
                return redirect()->to(url()->current().'?'.(http_build_query($request->except("price"))));
            }
        } 
        if(isset($_GET['manhinh'])&& is_array($_GET['manhinh']))
        {  
           
            $manhinh= $_GET['manhinh'];
           
           if(is_array($manhinh)&&$manhinh[0]=="tất-cả")
            {  
               // array_push($expect,$request->manhinh);
                return redirect()->to(url()->current().'?'.(http_build_query($request->except("manhinh"))));
            }
        
        } 
        if(isset($_GET['cpu'])&& is_array($_GET['cpu']))
        {  
           
            $cpu= $_GET['cpu'];
            if($cpu[0]=="tất-cả")
            {
                 //array_push($expect,$request->cpu);
               return redirect()->to(url()->current().'?'.(http_build_query($request->except("cpu"))));
            }
               
            
        } 
        if(isset($_GET['RAM'])&& is_array($_GET['RAM']))
        {  
           
            $ram= $_GET['RAM'];
            if($ram[0]=="tất-cả")
            {   
                 //array_push($expect,$request->RAM);
               return redirect()->to(url()->current().'?'.(http_build_query($request->except("RAM"))));
            }
        } 
        if(isset($_GET['ocung']) && is_array($_GET['ocung']))
        {  
          
            $ocung= $_GET['ocung'];
           
            if($ocung[0]=="tất-cả")
            {    
                 //array_push($expect,$request->ocung);
                return redirect()->to(url()->current().'?'.(http_build_query($request->except("ocung"))));
            
            }
        } 
        if(isset($_GET['tenhang']) && is_array($_GET['tenhang']))
        {  
           
            $tenhang= $_GET['tenhang'];
          
                if($tenhang[0]=="tất-cả" || count($tenhang)=="1")
                { 
                  //array_push($expect,$request->tenhang);
             
                if(count($request->all())=="1")
                    return redirect()->to(url()->current());
                else
                    return redirect()->to(url()->current().'?'.(http_build_query($request->except("tenhang"))));
                }
            
        }   
      
      
           
        return $next($request);
    }
     
}
