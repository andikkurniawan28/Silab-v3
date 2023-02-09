<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRoleUserIs5
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        switch(Auth()->user()->role_id)
        {
            case 1 : return $next($request); break;
            case 2 : return $next($request); break;
            case 3 : return $next($request); break;
            case 4 : return $next($request); break;
            case 5 : return $next($request); break;
            default : return redirect()->back()->with('error', 'You are not permitted to access those page.'); break;
        }
    }
}
