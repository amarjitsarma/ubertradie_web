<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class AdminMiddleware
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
        $role = Sentinel::getUser()->roles()->first()->slug;
        if(Sentinel::check() && $role == 'admin'){
            return $next($request);            
        }else{
            return response()->view('errors.403');
        }
    }
}
