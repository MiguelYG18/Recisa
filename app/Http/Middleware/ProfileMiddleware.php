<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->status == 1 && Auth::user()->group->group_status == 1){
            if(Auth::user()->user_level==1 || Auth::user()->user_level == 2 || Auth::user()->user_level == 3){
                return $next($request);
            }else{  
                Auth::logout();
                return redirect(url('/401'));
            } 
        }else{
            Auth::logout();
            return redirect(url('/401'));
        }
    }
}
