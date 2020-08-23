<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\App;
class facebookRedirect
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
      
       
     
       // if($check)
       // {
           //$newUrl = str_replace("http","https",$url);
         
           //return $newUrl;
        //}

        return $next($request);
    }
}
