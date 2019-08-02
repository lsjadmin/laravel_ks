<?php

namespace App\Http\Controllers\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class FileController extends Controller
{
    //
        public function a(){
                return view('file.a');
        }
        public function b(Request $request){
         //  echo "a";
            $file=$request->file('file');
//            dd($file);
            if ($file->isValid()) {
                # 原文件名
                $originalName = $file->getClientOriginalName();
                # 扩展名
                $ext = $file->getClientOriginalExtension();
                # Mimetype
                $type = $file->getClientMimeType();
                # 临时绝对路径
                $realPath = $file->getRealPath();

                # 自定义文件名
                $fileName = date('Ymd').'/'.uniqid().'.'.$ext;

                # 选择磁盘
                $bool = Storage::disk('upload')->put($fileName, file_get_contents($realPath));
                dd($bool);
            }

        }
        

}
