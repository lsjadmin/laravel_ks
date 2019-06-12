<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
class GoodsMiddleware
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
        $id=$request->input('k_uid');
        //echo $id;die;
        $token=$request->input('token');
       //echo $token;die;
        $key="0531userid:$id";
        $a=Redis::get($key);
        // echo "redis";echo $a;
        if($a!==$token){
            $arr=[
                'error'=>40007,
                'msg'=>'请先登录'
            ];
            die(json_encode($arr,JSON_UNESCAPED_UNICODE));
        }else{

        }
        return $next($request);
    }
}
