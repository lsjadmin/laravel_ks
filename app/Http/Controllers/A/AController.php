<?php

namespace App\Http\Controllers\A;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Model\GoodsModel;
class AController extends Controller
{
    //
    public function a(){
           // echo "a";
        for($i=0;$i<300000;$i++){
            $len1=Str::random(5);
            $len2=rand(2,5);
            $a=[
                '@qq.com',
                '@163.com'
            ];
            $meail=Str::random(5).'@'.'qq.com';
            $info=[
                'name'=>$len1,
                'age'=>$len2,
                'email'=>$meail
            ];
            $id=GoodsModel::insertGetId($info);
            echo "id:".$id;echo"</br>";
        }
    }
}
