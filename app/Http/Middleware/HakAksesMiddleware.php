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
    public function handle($request, Closure $next, ...$nameRole)
    {

        foreach($nameRole as $role) {

            try {
                if ($request->user()->hasRole($role)) {
                  return $next($request);
            }

            } catch (ModelNotFoundException $exception) {
              return abort('401');
            }
        }
        // if(auth()->check() && !auth()->user()->hasRole($nameRole)){
        //     return abort('401');
        // }
        // return $next($request);
    }
}
