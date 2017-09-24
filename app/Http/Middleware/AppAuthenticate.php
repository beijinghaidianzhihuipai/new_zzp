<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Input;

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
        $request_all = Input::all();
        if(!isset($request_all['token'])){
            return new Response("无权访问！");
        }
        //$token = $_REQUEST['token'];

        return $next($request);
    }
}
