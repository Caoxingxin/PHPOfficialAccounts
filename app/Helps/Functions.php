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
}
