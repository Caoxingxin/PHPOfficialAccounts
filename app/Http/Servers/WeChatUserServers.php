<?php


namespace App\Http\Servers;


use App\Http\Model\WeChatUser;
use Illuminate\Support\Facades\DB;

class WeChatUserServers
{
    public function create($userMsg){
        try {
            DB::beginTransaction();
            $data = [
                'name' => $userMsg['ToUserName'],
                'openid' => $userMsg['FromUserName'],
                'avatar' => ''
            ];
            \Log::info($data,$userMsg);
            $ifexist = WeChatUser::query()->where('openid',$userMsg['FromUserName'])->count();
            if (!$ifexist){
                $wechatuser = WeChatUser::query()->create($data);
            }
            DB::commit();

            return $wechatuser->toArray();

        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
}
