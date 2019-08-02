<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\BackModel;
use Illuminate\Support\Str;
class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '测试';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
//        echo "1";
//        $where=[
//            'id'=>1
//        ];
//        $info=[
//            'b_name'=>Str::random(3)
//        ];
//        $info=BackModel::where($where)->update($info);
        $time=date("Y-m-d H:i:s")."\n";
        file_put_contents('/wwwroot/laravel_ks/public/log/a.log',$time,FILE_APPEND);
    }
}