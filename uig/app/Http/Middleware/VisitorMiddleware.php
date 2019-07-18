<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class VisitorMiddleware
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
       
        if(!Sentinel::check()){
            return $next($request);
        }else{
            $slug = Sentinel::getUser()->roles()->first()->slug;
            if($slug == 'admin')
                return redirect('/Users');
            elseif($slug == 'sales')
                return redirect()->route('sales.dashboard');
            elseif($slug == 'client')
                return redirect()->route('stock.dashboard');
        }
    }
}
