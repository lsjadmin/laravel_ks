<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
class ApiController extends Controller
{
    //登陆接口(对称加密)
    public function log(){
        $res=file_get_contents("php://input");  //接受用户信息
        //对称加密解密
        $method = 'AES-256-CBC';//加密方法
        $key = '123';//加密密钥
        $options = OPENSSL_RAW_DATA;//数据格式选项（可选）
        $iv='aassddffgghhjjkl';
        //解密
        $deb64=base64_decode($res);
        //echo $deb64;die;
        $resulta = openssl_decrypt($deb64, $method, $key, $options,$iv);
        $data=json_decode($resulta,true);
        $email=$data['email'];
        $password=$data['password'];
        $where=[
            'email'=>$email
        ];
        $user=UserModel::where($where)->first();
        if($user){
            if(password_verify($password,$user['password'])){
                $key="test_token";
                $token=$this->token();
                Redis::set($key,$token);
                Redis::expire($key,86400);
                $info=[
                    'error'=>2000,
                    'msg'=>'登陆成功',
                    'token'=>$token
                ];
                return json_encode($info,JSON_UNESCAPED_UNICODE);
            }else{
                $info=[
                    'error'=>40002,
                    'msg'=>'账号或者密码错误'
                ];
                return json_encode($info,JSON_UNESCAPED_UNICODE);
            }
        }else{
            $info=[
                'error'=>40001,
                'msg'=>'没有这个用户'
            ];
            return json_encode($info,JSON_UNESCAPED_UNICODE);
        }

    }
    //登陆接口（非对称加密）
    public function log2(){
        $res=file_get_contents("php://input");  //接受用户信息
        //非对称加密解密
        $ka=openssl_pkey_get_public('file://'.storage_path('app/keys/public.pem')); //获取公钥
        openssl_public_decrypt($res,$dec_date,$ka);
        $data=json_decode($dec_date,true);
        $email=$data['email'];
        $password=$data['password'];
        $where=[
            'email'=>$email
        ];
        $user=UserModel::where($where)->first();
        if($user){
            if(password_verify($password,$user['password'])){
                $key="test_token";
                $token=$this->token();
                Redis::set($key,$token);
                Redis::expire($key,86400);
                $info=[
                    'error'=>2000,
                    'msg'=>'登陆成功',
                    'token'=>$token
                ];
                return json_encode($info,JSON_UNESCAPED_UNICODE);
            }else{
                $info=[
                    'error'=>40002,
                    'msg'=>'账号或者密码错误'
                ];
                return json_encode($info,JSON_UNESCAPED_UNICODE);
            }
        }else{
            $info=[
                'error'=>40001,
                'msg'=>'没有这个用户'
            ];
            return json_encode($info,JSON_UNESCAPED_UNICODE);
        }

    }
    public function token(){
        $time=time();
        $rand=Str::random(20);
        $token=md5(substr($time.$rand,0,10));
        return $token;
    }
    public function test(){
        
    }
}
