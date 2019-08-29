<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
   // phpinfo();
});

//考试测试
Route::post('/exam/login','Exam\ExamController@login');//登陆
Route::post('/exam/add','Exam\ExamController@add');//增
Route::get('/exam/show','Exam\ExamController@show');//查
Route::get('/exam/delete','Exam\ExamController@delete');//删除
Route::post('/exam/update','Exam\ExamController@update');//修改

Route::get('/exam/index','Exam\ExamController@index');//html页面

Route::get('/exam/adddo','Exam\ExamController@adddo');//添加图片

//测试

Route::group(['middleware' => ['power']], function () {
    //
    Route::any('/exam/power','Exam\ExamController@power');
    Route::get('/exam/delete','Exam\ExamController@delete');//删除
});


//多人聊天
Route::get('/chat/reg','Chat\ChatController@reg');//注册
Route::post('/chat/regdo','Chat\ChatController@regdo');//注册执行
Route::get('/chat/login','Chat\ChatController@login');//登陆
Route::post('/chat/logindo','Chat\ChatController@logindo');//登陆执行

Route::get('/chat/chat','Chat\ChatController@chat');//聊天室
Route::post('/chat/chatdo','Chat\ChatController@chatdo');//聊天室添加
Route::get('/chat/chatdesc','Chat\ChatController@chatdesc');//内容执行
Route::get('/chat/aa','Chat\ChatController@aa');//测试session

//mongo
Route::get('/mongodb/one','Mongo\MongoController@mongodb1');
Route::get('/mongodb/delete','Mongo\MongoController@mongodb2');
Route::get('/mongodb/find','Mongo\MongoController@find');
Route::get('/mongodb/update','Mongo\MongoController@update');
Route::get('/mongodb/swoole','Mongo\MongoController@swoole');
Route::get('/mongodb/chat','Mongo\MongoController@chat');
//测试
Route::get('/test/a','A\AController@a');
Route::get('/test/b','A\BbController@b');
//测试分表
Route::get('/exam/test','Exam\ExamController@test');
Route::get('/exam/pshow','Exam\ExamController@pshow');
Route::get('/exam/partition','Exam\ExamController@partition');//范围分区
Route::get('/exam/partitionlist','Exam\ExamController@partitionlist');//list分区
//切片上传
Route::get('/file/a','File\FileController@a');
Route::post('/file/b','File\FileController@b');
//jq上传图片image1
Route::get('/file/image','File\ImageController@image');
Route::post('/file/image1','File\ImageController@image1');
Route::get('/file/test','File\ImageController@test');
//测试邮箱发送
Route::get('/email','Email\EmailController@email');
//测试redis incr
Route::get('/test/abtest','Exam\ExamController@abtest');
//测试无限极分类
Route::get('/test/test01','Exam\ExamController@test01');
//测试mysql主主
Route::get('/test/mysql','Exam\ExamController@mysql');
//发送短信验证码
Route::get('/note/note','Note\NoteController@note');
//测试表单验证
Route::get('/verify/test','Verify\VerifyController@test');
Route::post('/verify/push','Verify\VerifyController@push');  //添加
//队列
Route::get('/queue/test','Queue\QueueController@queue');  //数据库队列
Route::get('/queue/redis','Queue\QueueController@queueredis');  //redis队列
//微信image1
Route::get('/wei/token','Weixin\WeiController@token');  //获得token
Route::get('/wei/mass','Weixin\WeiController@mass');  //群发
//测试redis
Route::get('/redis/redis','Redis\RedisController@redis');  //测试
//测试restful
Route::resource('post','Restful\PostController');
//登陆接口
Route::post('/api/log','Api\ApiController@log'); //对称加密
Route::post('/api/log2','Api\ApiController@log2');//非对称加密
Route::post('/api/sign','Api\ApiController@sign');//自定义签名
//1907考试题测试（event）
Route::get('/event/add','Event\EventController@EventAdd'); //添加页面
Route::get('/event/adda','Event\EventController@EventAdda'); //添加
Route::get('/event/time','Event\EventController@time');    //时间


