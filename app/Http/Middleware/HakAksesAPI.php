<?php

namespace App\Http\Middleware;

use Closure;

class HakAksesAPI
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
                return response()->json(['status'  => 401,
                                         'message' => 'You dont have a permission for this endpoint']);
              }
          }
          return response()->json(['status'  => 401,
                                   'message' => 'You dont have a permission for this endpoint']);

        // if(auth()->check() && !auth()->user()->hasRole($nameRole)){
        //     return abort('401');
        // }
        // return $next($request);
    }
}
