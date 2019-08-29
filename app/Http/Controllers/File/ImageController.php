<?php

namespace App\Http\Controllers\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class ImageController extends Controller
{
    //
    public function image(){
        return view('file/image');
    }
    public function image1(Request $request){
        $picture=$request->file('picture');
        if ($picture->isValid()) {
            $originalName = $picture->getClientOriginalName(); // 文件原名
            $ext = $picture->getClientOriginalExtension();     // 扩展名
            $realPath = $picture->getRealPath();   //临时文件的绝对路径
            $type = $picture->getClientMimeType();
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
        }


        }

    public function test(){
        for($i=1;$i<=5;$i++){
            echo "$i";
            break;
            echo "dhjdhjhj";
        }
    }

}
