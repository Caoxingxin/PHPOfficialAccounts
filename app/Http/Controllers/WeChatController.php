<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Overtrue\Socialite\User as SocialiteUser;

class WeChatController extends Controller
{
    //
    public function __construct()
    {
        $user = new SocialiteUser([
            'id' => 'mock-openid',
            'name' => 'overtrue',
            'nickname' => 'overtrue',
            'avatar' => 'http://example.com/avatars/overtrue.png',
            'email' => null,
            'original' => [],
            'provider' => 'WeChat',
        ]);
    }

    public function serve(){
        Log::info('request arrived.');
        $app = app('wechat.official_account');
        $app->server->push(function($message){
            return '欢迎关注 overtrue';
        });
        return $app->server->serve();
    }
}
