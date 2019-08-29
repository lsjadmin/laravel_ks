<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\EventModel;
class EventController extends Controller
{
    /*
     * 活动添加（页面）
     */
    public function EventAdd(){

        return view('event.add');
    }
    /*
     * 活动添加
     */
    public function EventAdda(){
        $name=$_GET['name'];
        $tel=$_GET['tel'];
        $num=10;  //活动人数

       $info=[
           'e_name'=>$name,
           'e_tel'=>$tel,
           'create_time'=>time()
       ];
       $create=EventModel::insert($info);
       $count=EventModel::count();

       if($create){
           $a=$num-$count;   //报名剩余人数。

           $arr=[
               'err'=>1,
               'num'=>$a
           ];
           return json_encode($arr,JSON_UNESCAPED_UNICODE);
       }


    }
    //活动时间
    public function time(){
        $time=time()+84600;
        $set=date("Y-m-d,H:i:s",$time);  //集合时间
        $end=date("Y-m-d");              //结束时间(集合前一天的时间晚上11点前)

        if($set && $end){
            $arr=[
                'err'=>1,
                'set'=>$set,
                'end'=>$end
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else{
            echo "2";
        }
    }
}
