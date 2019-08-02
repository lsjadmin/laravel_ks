<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
class WeiController extends Controller
{
    //获得token
    public function token(){
        $key="access_token";
        $access_token=Redis::get($key);
        if($access_token){
         return $access_token;
        }else{
            $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WX_APPID').'&secret='.env('WX_APPSECRET');
            $response=json_decode(file_get_contents($url),true);
            if(isset($response['access_token'])){
                Redis::set($key,$response['access_token']);
                Redis::expire($key,3600);
              return $response['access_token'];
            }else{
                return false;
            }//return $response;
        }
    }
    //群发
    public function mass(){
        $token=$this->token();
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=$token";
        // echo '原文:'.$b64;echo "<hr>";
        $text=Str::random(10);
        $arr=[
            "touser"=>[
                "o4ekM6OGBsZGiaWAnqqd3ADbUw84",
                "o4ekM6MX0DCu_8fmTXaECirRFjjc"
            ],
            "msgtype"=>"text",
            "text"=>
                [
                    "content"=>$text,
                ],
        ];
        $info=json_encode($arr);
        //初始化curl
        $ch=curl_init();
        //通过 curl_setopt() 设置需要的全部选项
        curl_setopt($ch, CURLOPT_URL,$url);
        //禁止浏览器输出 ，使用变量接收
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST,1);
        //把数据传输过去
        curl_setopt($ch,CURLOPT_POSTFIELDS,$info);
        //执行会话
        curl_exec($ch);
        //结束一个会话
        curl_close($ch);

    }
    //把用户信息存的数据库
    public function valid(){
        echo $_GET['echostr'];
    }

    public function wxEvent(){
        $content=file_get_contents("php://input");

    }
}
