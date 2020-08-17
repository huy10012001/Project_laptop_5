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
       
        if($request->price)
        {  
          
            $price= $_GET['price'];
            if(in_array("tất-cả",$price))
            {
               // array_push($expect,$request->price);
                return redirect()->to(url()->current().'?'.(http_build_query($request->except("price"))));
            }
        } 
        if($request->manhinh)
        {  
           
            $manhinh= $_GET['manhinh'];
           
           if(in_array("tất-cả",$manhinh))
            {  
               // array_push($expect,$request->manhinh);
                return redirect()->to(url()->current().'?'.(http_build_query($request->except("manhinh"))));
            }
        
        } 
        if($request->cpu)
        {  
           
            $cpu= $_GET['cpu'];
            if(in_array("tất-cả",$cpu))
            {
                 //array_push($expect,$request->cpu);
               return redirect()->to(url()->current().'?'.(http_build_query($request->except("cpu"))));
            }
               
            
        } 
        if($request->RAM)
        {  
           
            $ram= $_GET['RAM'];
            if(in_array("tất-cả",$ram))
            {   
                 //array_push($expect,$request->RAM);
               return redirect()->to(url()->current().'?'.(http_build_query($request->except("RAM"))));
            }
        } 
        if($request->ocung) 
        {  
          
            $ocung= $_GET['ocung'];
           
            if(in_array("tất-cả",$ocung))
            {    
                 //array_push($expect,$request->ocung);
                return redirect()->to(url()->current().'?'.(http_build_query($request->except("ocung"))));
            
            }
        } 
        if($request->tenhang)
        {  
           
              $tenhang= $_GET['tenhang'];
         
                if(in_array("tất-cả",$tenhang) || count($tenhang)=="1")
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
