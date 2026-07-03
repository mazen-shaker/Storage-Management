<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth; 
use Closure;
use Illuminate\Support\Facades\Session;

class CheckSidebarPermissions
{
    public function handle($request, Closure $next)
    {


    
            if (Auth::check() && Auth::user()->prev_id === 1) {
                return $next($request); 
            }
    
            return redirect()->route( route: 'home');
    
    }
}