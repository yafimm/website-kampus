<?php

namespace App\Http\Middleware;

use Closure;

class HakAksesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $nameRole)
    {
        if(auth()->check() && !auth()->user()->hasRole($nameRole)){
            return redirect('/400');
        }
        return $next($request);
    }
}
