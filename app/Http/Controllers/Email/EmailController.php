<?php

namespace App\Http\Controllers\Email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
class EmailController extends Controller
{
    //
    public function email(){
            // Mail::raw('邮箱测试',function($message){
            //         $message->from('lianshijied@163.com','52Hz'); //发送人的账号和名称
            //         $message->subject('测试');    //主题
            //         $message->to('3023668879@qq.com');  
            // });
            //email.email 第一个参数想发送HTML的位置
            //['name'=>'lianshijie']  传到html的数据
            Mail::send('email.email',['name'=>'lianshijie'],function($message){
                $message->to('3023668879@qq.com');  //发送的邮箱号
            });
    }
}
