<?php

namespace App\Http\Controllers\Mongo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MongoDB\Client;
class MongoController extends Controller
{

     public $con='mongodb://127.0.0.1:27017';
     public $client;

    public function __construct()
    {
       $this->client=new Client($this->con);
    }
    //insert
    public function mongodb1(){
        $collection=$this->client->a1809->test1;
        //        $con = 'mongodb://127.0.0.1:27017';
        //        $client=new Client($con);
        //        $collection=$client->a1809->test1;
            //添加一条
        //        $info=[
        //            'name'=>"cuicui",
        //            'age'=>12,
        //            'sex'=>'nv'
        //        ];
        //        $collection->insertOne($info);
        $info=[
            [
                'name'=>"张玉珍",
                'age'=>12,
                'sex'=>'nv'
            ],
            [
                'name'=>"倪青秀",
                'age'=>12,
                'sex'=>'nv'
            ],
            [
                'name'=>"宋薇",
                'age'=>12,
                'sex'=>'nv'
            ],
            [
                'name'=>"连世杰",
                'age'=>12,
                'sex'=>'nv'
            ],
        ];
      $collection->insertMany($info);
        // $collection->deleteOne(['name'=>'连世杰']);
        var_dump($collection);
        
    }
    //delete
    public function mongodb2(){
        $collection=$this->client->a1809->test1;
        //删除所有name=cuicui
        //deleteOne  删除单个
        $collection->deleteMany(['name'=>'cuicui']);
        var_dump($collection);
    }
    //find
    public function find(){
        $collection=$this->client->a1809->test1;
        $a=$collection->find()->toArray();
        echo "<pre>";print_r($a);echo"</pre>";
    }
    //update
    public function update(){
        $collection=$this->client->a1809->test1;
        //updateone 修改一个 updatemany name为倪青秀的 age都修改成一100
        $collection->updateMany(['name'=>'倪青秀'],['$set'=>['age'=>100]]);
    }
    public function swoole(){
        return view('swoole.index');
    }
    //聊天室
    public function chat(){
        return view('swoole.chat');
    }


}
