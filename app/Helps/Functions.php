<?php


namespace App\Helps;


use Illuminate\Support\Facades\Log;

class Functions
{
    function curlGet($url, $params, $headers = [], $log = true)
    {
        if (!empty($params)) {
            $url = "{$url}?" . http_build_query($params);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        $total_time = curl_getinfo($ch)['total_time'];
        $error = curl_error($ch);
        if ($log) {
            Log::info('请求地址: ' . $url . ' 消耗时长： ' . $total_time . 's' . " 错误信息:" . $error);
        }
        curl_close($ch);
        return $result;
    }
    public function DayliMsg(){
        $msg = [
            [
                'Give you a good mood, WISH you happy - health;  Give you a lofty ideal, may you struggle for life;  Give you a spiritual space, may you enrich - life.  Give you - a charge: take good care of yourself.  Good morning!',
                '送给你一份好心情，愿你快乐-生;送给你一个远大理想，愿你奋斗终身;送给你一个心灵空间，愿你去充实一生。送给你一个嘱咐:好好爱惜自己就行。早上好!'
            ],
            [
                'My mobile phone in spring open your heart, summer to you cool, autumn bring you harvest, winter burning you excited - feeling;  Difficulties often send you to smooth, think of me when I send you my blessing.  Good morning!',
                '春天吹开你的心扉，夏天传给你凉爽，秋天带给你收获，冬天燃烧你的激情；困难时常给你送去顺利，想我的时候发给你我的祝福。早上好！'
            ],
            [
                'Flashing information is full of happy expectations, treasured memories are never fade watercolor, the happiness of the heart is because of your existence, deep concern condenses sincere feelings!  May: blessings often, friendship long in!  Good morning!',
                '闪烁的信息充满幸福的期待，珍藏的回忆是永不退色的水彩，心灵的快乐是因为有你的存在，深深的挂念凝聚真挚的情怀！愿：祝福常有，情谊长在！早上好！'
            ],
        ];
        return $msg[mt_rand(0,2)];
    }
}
