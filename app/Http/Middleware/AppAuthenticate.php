<?php

namespace App\Http\Middleware;

use Closure;

class AppAuthenticate
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
       // $token = $_REQUEST['token'];
        //echo $token;die;
        return $next($request);
    }
}
