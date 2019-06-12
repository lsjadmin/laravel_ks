<?php

namespace App\Http\Controllers\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use App\Model\KsGoodsModel;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use App\Model\PowerModel;
use App\Model\PadminModel;
class ExamController extends Controller
{
    //登陆接口
    public function login(Request $request){
        $user_name=$request->input('user_name');
        $user_pwd=$request->input('user_pwd');
            $where=[
                'user_name'=>$user_name
            ];
        $res=UserModel::where($where)->first();
        //dd($res);
        $json_str=json_encode($res);
        //dd($json);
        //获得私钥
        $k=openssl_pkey_get_private('file://'.storage_path('app/keys/private.pem'));
        openssl_sign($json_str,$sign,$k);//$sign 生成的密签
        //echo $sign;
        $b64=base64_encode($sign);  //把加密数据转换成base64
        $user_id=$res->k_uid;
        if($res){
            if($user_pwd==$res->user_pwd){
                $key="0531userid:$user_id";
                $token=$this->token();
                Redis::set($key,$token);


                $p_id=PadminModel::where(['k_uid'=>$user_id])->pluck('p_id');
                $power=PowerModel::whereIn('p_id',$p_id)->pluck('web')->toArray();

                $json_power=json_encode($power);
                Redis::set($user_id,$json_power);
                dd($power);
                $arr=[
                    'error'=>200,
                    'msg'=>'登陆成功',
                    'date'=>$b64
                ];
                return json_encode($arr,JSON_UNESCAPED_UNICODE);
            }else{
                $arr=[
                    'error'=>40002,
                    'msg'=>'账户或者密码不对'
                ];
                return json_encode($arr,JSON_UNESCAPED_UNICODE);
            }
        }else{
            $arr=[
                'error'=>40001,
                'msg'=>'没有此用户'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }
    //增
    public function add(Request $request){
        $data=$request->input();
        //dd($data);
        $img=$_FILES;
        //dd($img);
        $data['addtime']=time();
        $data['kgoods_img']='/'.'img/'.$img['kgoods_img']['name'];
        // dd($data);
        $add=KsGoodsModel::insert($data);
        if($add){
            $arr=[
                'error'=>200,
                'msg'=>'添加成功'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else{
            $arr=[
                'error'=>40001,
                'msg'=>'添加失败'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }
    //查
    public function show(Request $request){
        $goodsInfo=KsGoodsModel::get();
        //对数据进行对称加密
       $data=json_encode($goodsInfo,JSON_UNESCAPED_UNICODE);
        $method = 'AES-256-CBC';//加密方法
        $key = '123';//加密密钥
        $options = OPENSSL_RAW_DATA;//数据格式选项（可选）
        $iv='aassddffgghhjjkl';
        $result = openssl_encrypt($data, $method, $key, $options,$iv);
        // echo $result;
        $b64=base64_encode($result);

        if($goodsInfo){
            $arr=[
                'error'=>200,
                'msg'=>'查找成功',
                'data'=>$b64
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else{
            $arr=[
                'error'=>40001,
                'msg'=>'查找失败'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }

    }
    /*
     * 删除
     * 传个gid
     */
    public function delete(Request $request){
        $id=$_GET['k_gid'];
       // dd($id);
        $res=KsGoodsModel::where(['k_gid'=>$id])->delete();
        if($res){
            $arr=[
                'error'=>200,
                'msg'=>'删除成功'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else{
            $arr=[
                'error'=>4001,
                'msg'=>'删除失败'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }
    //修改
    public function update(Request $request){
         $data=$request->input();
        //dd($data);
        $where=[
            'k_gid'=>$data['k_gid'],
        ];
        $info=[
            'kgoods_name'=>$data['kgoods_name'],
            'kgoods_price'=>$data['kgoods_price']
        ];
        $arr=KsGoodsModel::where($where)->update($info);
        if($arr){
            $arr=[
                'error'=>200,
                'msg'=>'修改成功'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }else{
            $arr=[
                'error'=>40001,
                'msg'=>'修改失败'
            ];
            return json_encode($arr,JSON_UNESCAPED_UNICODE);
        }

    }
    //ajaxhtml
    public function index(){
        return view('exam.index');
    }
    //添加图片
    public function adddo(){
        $url="http://1809a.ks.com/exam/add";
        $cfile = curl_file_create('./img/0531.jpg','jpg','0531.jpg');
        $date=[
            'kgoods_name'=>'oppo',
            'kgoods_price'=>5000,
            'kgoods_img'=>$cfile
        ];
        //        $date[]=$cfile;
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$date);
        curl_exec($ch);
        $error=curl_errno($ch);
        echo $error;echo"</br>";
        curl_close($ch);
    }

    //token
    function token(){
        $str=Str::random(10);
        $token=substr(md5($str),5,10);
        return $token;
    }

    //测试power
    public function power(){
        echo "a";
    }

}
