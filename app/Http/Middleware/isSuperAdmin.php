<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isSuperAdmin
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
        if(Auth::user() && Auth::user()->roles == 'SUPERADMIN')
        {
             return $next($request);
        }

        else if(Auth::user() && Auth::user()->roles == 'ADMIN'){
            return redirect()->route('dashboard.admin');    
        }

        return redirect('/');

    }
}
