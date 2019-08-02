<?php

namespace App\Http\Controllers\Queue;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\GoodsModel;
use App\Jobs\Jobtest;
use Mail;
class QueueController extends Controller
{
    //数据库队列（发送邮箱）
    public function queue(){
//        $info=GoodsModel::where(['goods_id'=>2])->first();
//        dd($info);
//      $this->dispatch(new SendEmail("3023668879@qq.com"));
    }
    //redis 队列（发送邮箱）
    public function queueredis(){

        Jobtest::dispatch()->onQueue('1809a_email');
        echo "测试成功";die;
    }
}
