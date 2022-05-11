<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Wxmessage extends Controller
{

    public function message(){
        $opts = [
          'http'=>[
              'method' => 'GET',
              'timeout' => 2
          ]
        ];
        $context = stream_context_create($opts);
        $html =file_get_contents('http://2pgq2b.natappfree.cc/Temp/WxMessage.php', false, $context);
        echo $html;
    }




}
