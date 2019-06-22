<?php

namespace App\Http\Controllers\A;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class BbController extends Controller
{
    //
    public function b(){
        $res=DB::table('ks_user')->get();
        dd($res);
    }
}
