<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticated
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
        if(Auth::check() )
            return $next($request);
        return abort('404');
        if (auth()->user()-> role->name="admin") {
            return $next($request);
        }
    
        return abort(404);
    }
}
