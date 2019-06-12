<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
class PowerMiddleware
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
        $path=$request->path();
        $method=$request->method();
        $uid=$request->input('uid');
        //dd($uid);
        $web=Redis::get($uid);
       // dd($web);
        $array=json_decode($web);
        // dd($array);
        if(in_array($path,$array)){
            echo "true";
        }else{
            echo "no";
        }
        
        return $next($request);
    }
}
