<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class BackendMiddleware
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
        if (!(backpack_user()->is_admin)){
            Session::flush();
            return response(trans('backpack::base.unauthorized'),401);
        }
            
        return $next($request);
    }
}
