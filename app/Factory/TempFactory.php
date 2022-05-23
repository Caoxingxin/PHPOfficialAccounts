<?php


namespace App\Factory;


class TempFactory
{
    public function setTemp($name=''){
        if (isset($name)){
            //yxl单独发送
            return [
                'name' => ['猪猪','#787878'],
                'day' => [date('Y-m-d H:i:s'),'#7A378B'],
                'salaryDay' => ['22天','#C5C1AA'],
                'site' => ['重庆'],
                'temp_low' => ['17度','#C5C1AA'],
                'temp_high' => ['28度','#C5C1AA'],
                'message' => ['今天也是元气满满的一天，加油哦！ヾ(◍°∇°◍)ﾉﾞ']
            ];
        }
        return [];
    }
}
