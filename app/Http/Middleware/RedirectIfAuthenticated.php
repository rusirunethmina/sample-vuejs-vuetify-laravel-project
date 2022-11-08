<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (!auth()->User()->isActive()) {
                return redirect('/blocked');
            }else{
                if (auth()->User()->isAdmin()){
                    return redirect('/development');
                }
                elseif (auth()->User()->isPlaning()){
                    return redirect('/planning');
                }              
                else{
                    return redirect('/');
                }

            }
        }
        return $next($request);
    }
}
