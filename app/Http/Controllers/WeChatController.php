<?php

namespace App\Http\Controllers;

use App\Factory\MessageTypeFactory;
use App\Http\Servers\WeChatTempServers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Overtrue\LaravelWeChat\Events\WeChatUserAuthorized;
use Overtrue\Socialite\User as SocialiteUser;

class WeChatController extends Controller
{
    //测试联通性
    public function userData(){
        $user = session('wechat.oauth_user.default'); // 拿到授权用户资料
        $event = new WeChatUserAuthorized($user,true,'Laravel');
        dd($user);
    }
    /*
     * @todo Message默认类型
     * <xml>
          <ToUserName><![CDATA[toUser]]></ToUserName>
          <FromUserName><![CDATA[fromUser]]></FromUserName>
          <CreateTime>12345678</CreateTime>
          <MsgType><![CDATA[image]]></MsgType>
          <Image>
            <MediaId><![CDATA[media_id]]></MediaId>
          </Image>
       </xml>
     */
    public function serve(){
        Log::info('request arrived.');
        $app = app('wechat.official_account');
        $app->server->push(function($message)use ($app){
            if(strstr($message['Content'], '模')){
                //发送模板
                $wechat = new WeChatTempServers($app);
                $wechat->addTemp('UhEz1wikkkR_6g4HHrL5Ao7AeqjFWNRdFA9phg-mJDM','oHs895nn87fR9KKzbDH16bsC8vjE');
                return ;
            }
            switch($message['MsgType']){
                case 'event':
                    //subscribe为订阅事件
                    if ($message['Event'] == 'subscribe') {
                        return '欢迎关注 caoxinxin公众号！';
                    }
                    break;
                case 'text':
                    //发送图文
                    $TypeFactory = new MessageTypeFactory;
                    return $TypeFactory->changeType('news');
                    break;
                case  'image':
                    return '这是图片';
                case  'voice':
                    return '这是语音';
            }
        });
        return $app->server->serve();
    }
}
