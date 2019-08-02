<?php

namespace App\Http\Controllers\Note;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    //
        public function note(){
      
            $host = "http://dingxin.market.alicloudapi.com";
            $path = "/dx/sendSms";
            $method = "POST";
            $appcode = "80eb4c49258c4835a578e57156e98969";
            $headers = array();
            array_push($headers, "Authorization:APPCODE " . $appcode);
            $querys = "mobile=18632839976&param=code%3A888&tpl_id=TP1711063";
            $bodys = "";
            $url = $host . $path . "?" . $querys;
        
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_FAILONERROR, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, true);
            if (1 == strpos("$".$host, "https://"))
            {
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            }
            var_dump(curl_exec($curl));
    

        }


}
