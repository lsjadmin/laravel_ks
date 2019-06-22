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
