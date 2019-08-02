<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
class Jobtest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $time=date("Y-m-d H:i:s");
        $con="测试king";
        $data=$time.$con."\n";
        file_put_contents("/wwwroot/laravel_ks/public/log/queue.log",$data,FILE_APPEND);
//        Mail::raw('邮箱测试',function($message){
//            $message->from('lianshijied@163.com','52Hz'); //发送人的账号和名称
//            $message->subject('测试'); //主题
//            $message->to("3023668879@qq.com");
//        });
    }
}
