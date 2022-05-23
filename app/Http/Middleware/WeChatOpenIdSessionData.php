<?php

namespace App\Http\Middleware;

use Closure;
use Overtrue\Socialite\User as SocialiteUser;
use Overtrue\LaravelWeChat\Events\WeChatUserAuthorized as WeChatEvents;

class WeChatOpenIdSessionData
{

    protected  $user = [];
    public function __construct()
    {
        $this->user = new SocialiteUser([
            //openid
            'id' => 'oHs895nn87fR9KKzbDH16bsC8vjE',
            'name' => 'overtrue',
            'nickname' => 'overtrue',
            'avatar' => 'https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLP5gCYUZQnVNIibtN4bvr6sgvib9aFhZ0lCfz47D2YGm4Sxg3Q4Qphy0LibdeIWSpDKwdNIG1bYhMpQ/132',
            'email' => null,
            'original' => [
                'openid' => 'oHs895nn87fR9KKzbDH16bsC8vjE',
                'nickname'=> 'overtrue',
                'sex'=> 0,
                'language'=> '',
                'city'=> '',
                'province'=> '',
                'country'=> '',
                'headimgurl'=> 'https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLP5gCYUZQnVNIibtN4bvr6sgvib9aFhZ0lCfz47D2YGm4Sxg3Q4Qphy0LibdeIWSpDKwdNIG1bYhMpQ/132',
                'privilege'=> '',
            ],
            'provider' => [],
        ]);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$event = new WeChatEvents($this->user,true,'Laravel');
        //dump(123,$this->user,$event->user);
        session(['wechat.oauth_user.default,snsapi_userinfo' => $this->user]);
        return $next($request);
    }
}
