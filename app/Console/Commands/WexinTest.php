<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WexinTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wexin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '微信测试';

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
        $time=date("Y-m-d H:i:s")."\n";
        file_put_contents('/wwwroot/laravel_ks/public/log/c.log',$time,FILE_APPEND);
    }
}
