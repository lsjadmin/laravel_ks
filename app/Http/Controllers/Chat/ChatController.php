<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\loginModel;
use App\Model\ChatModel;
class ChatController extends Controller
{
    //注册
    public function reg(){
        return view('chat.reg');
    }
    //注册执行
    public function regdo(){
        $user_name=request()->input('user_name');
        $user_pwd=request()->input('user_pwd');
        $pwd=request()->input('pwd');
        if($user_pwd!==$pwd){
            die('密码和确认密码不一样');
        }
        $pwda=password_hash($user_pwd,CRYPT_BLOWFISH);
        $info=[
            'user_name'=>$user_name,
            'user_pwd'=>$pwda,
            'add_time'=>time()
        ];
        $res=loginModel::insert($info);
        if($res){
            echo "ok";
        }else{
            echo "no";
        }
    }
    //登陆
    public function login(){
        return view('chat.login');
    }
    //登陆执行
    public function logindo(){
        $user_name=$_POST['user_name'];
        $user_pwd=$_POST['user_pwd'];
       // echo $user_name;
        $where=[
            'user_name'=>$user_name
        ];
        $res=loginModel::where($where)->first();
        //dd($res);
        if($res){
                if(password_verify($user_pwd,$res['user_pwd'])){
                   session(['res'=>$res]);
                    $arr=[
                        'err'=>1,
                        'msg'=>'登陆成功'
                    ];
                    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
                }else{
                    $arr=[
                        'err'=>2,
                        'msg'=>'密码或者用户不对'
                    ];
                    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
                }
        }else{
            $arr=[
                'err'=>0,
                'msg'=>'没有这个用户'
            ];
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }
    //聊天室
    public function chat(){
        $res=session('res');
        $user_name=$res['user_name'];
        //dd($user_name);
        return view('chat/chat',['user_name'=>$user_name]);
    }
    //测试session
    public function aa(){
        $user_name=session('user_name');
        echo $user_name;
    }
    //聊天室执行
    public function chatdo(){
        $chat_desc=$_POST['chat_desc'];
        //echo  $chat_desc;
        $res=session('res');
        $user_id=$res['user_id'];
        $user_name=$res['user_name'];
        $info=[
            'user_id'=>$user_id,
            'chat_desc'=>$chat_desc,
            'add_time'=>time()
        ];
        $res=ChatModel::insert($info);
        if($res){
            $arr=[
                'err'=>1,
                'msg'=>'添加成功',
                'user_name'=>$user_name
            ];
            return $arr;
        }else{
            $arr=[
                'err'=>2,
                'msg'=>'添加失败'
            ];
            return $arr;
        }
    }
    //内容展示
    public function chatdesc(){
        $res=session('res');
        $user_id=$res['user_id'];
        $user_name=$res['user_name'];
        $where=[
            'user_id'=>$user_id
        ];
        $chatinfo=ChatModel::where($where)->orderby('add_time','desc')->first('chat_desc');
        //dd($chatinfo);
        $chat_desc=$chatinfo['chat_desc'];
       // dd($chat_desc);
        $arr=[
            'err'=>1,
            'msg'=>'ok',
            'chat_desc'=>$chat_desc,
            'user_name'=>$user_name
        ];
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    }
}
