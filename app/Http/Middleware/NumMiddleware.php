<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class NumMiddleware
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
        //echo "231";
        $hash=substr(md5($_SERVER['REQUEST_URI']),5,10);
        $key="num:$hash";
        Redis::incr($key);
        Redis::expire($key,60);
        $num=Redis::get($key);

        if($num>=10){
            Redis::expire($key,180);
            $arr=[
                'error'=>40004,
                'msg'=>'超过调用次数'
            ];
            die(json_encode($arr,JSON_UNESCAPED_UNICODE));
        }
        return $next($request);
    }
}
