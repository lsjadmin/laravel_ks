<?php

namespace App\Http\Controllers\Verify;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPost;
class VerifyController extends Controller
{
    //表单验证
    public function test(){
            return view("verify.test");

    }
    //添加数据库
    public function push(StoreBlogPost $request){
        $validated = $request->validated();
        $data=$request->all();
//        $validatedData = $request->validate([
//            'name' => 'required|unique:posts|max:255',
//            'pwd' => 'required',
//        ]);

    }
}
