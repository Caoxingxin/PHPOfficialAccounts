<?php

namespace App\Http\Controllers;

use App\Factory\MessageTypeFactory;
use App\Http\Servers\WeChatTempServers;
use App\Http\Servers\WeChatUserServers;
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
    public function serve(WeChatUserServers $weChatUserServers){
        Log::info('request arrived.');
        $app = app('wechat.official_account');
        $app->server->push(function($message)use ($app,$weChatUserServers){
            if(strstr($message['Content'], '模')){
                //发送模板
                $wechat = new WeChatTempServers($app);
                //杨秀丽opid = 'oHs895kJuaXo3OoEGu9os-U3YNM0'
                //我的openid = 'oHs895nn87fR9KKzbDH16bsC8vjE'
                $wechat->addTemp('YIzkauwMW4Tspe7PVqJecG-7YccWSpbB4OoXiOY9UwE','oHs895nn87fR9KKzbDH16bsC8vjE');
                $wechat->addTemp('YIzkauwMW4Tspe7PVqJecG-7YccWSpbB4OoXiOY9UwE','oHs895kJuaXo3OoEGu9os-U3YNM0');
                return ;
            }
            switch($message['MsgType']){
                case 'event':
                    //subscribe为订阅事件
                    if ($message['Event'] == 'subscribe') {
                        //关注把openid放入数据库
                        $wechatuser = $weChatUserServers->create($message);
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
    public function menu(){
        $app = app('wechat.official_account');
        //菜单
        (new WeChatMenuServers())->createMenu($app);
        return '创建成功';
    }
}
