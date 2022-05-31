<?php


namespace App\Factory;


use App\Helps\Functions;

class TempFactory
{
    private $week = ['星期天','星期一','星期二','星期三','星期四','星期五','星期六'];
    public function setTemp($name=''){
        if (isset($name)){
            //yxl单独发送
            $weatherData = [
                //高德地图控制台的key
                'key' => 'd5c63b169d3ffbedfc579d27dde9107e',
                'city' => '440106',
                'extensions' => 'base',
                'output' => 'JSON'
            ];
            $result = json_decode((new Functions())->curlGet('https://restapi.amap.com/v3/weather/weatherInfo',$weatherData),true);
            if ($result['status'] == 1){
                $weatherRes = reset($result['lives']);
            }else{
                return [];
            }
            $msg = (new Functions())->DayliMsg();
            return [
                'name' => ['小可爱','#7A378B'],
                'day' => [date('Y-m-d').$this->week[date('w',time())],'#7A378B'],
                'site' => [$weatherRes['province'].$weatherRes['city'],'#7A378B'],
                'weather' => [$weatherRes['weather'],'#7A378B'],
                'temp_low' => ['暂无','#7A378B'],
                'temp_high' => [$weatherRes['temperature'].'°','#7A378B'],
                'ENMsg' => ['','#7A378B'],
                'CHMsg' => [$msg[1],'#7A378B'],
                'message' => ['今天也是元气满满的一天，加油哦！ヾ(◍°∇°◍)ﾉﾞ','#7A378B']
            ];
        }
        return [];
    }
}
