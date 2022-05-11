<?php


class Temp
{
    public function testTemp($access_token,$openid,$dataday){
        $templateid = 'WU1kZKhfBrAuhEF0M4viN3E5UmiCC_5bfE0oGeR2Utk';
        //$title = "模板消息发送成功！";
        $title = $dataday['citynm'];
        $data1 = "测试模板消息发送";
        $data2 = "开发员！";
        $data3 = date("Y年m月d日 H:i", time());
        $remark = "当前为测试模板可任意指定内容，但实际上正式帐号的模板消息，只能从模板库中获得";

        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
        /*
         * @miniprogram 跳小程序所需数据，不需跳小程序可不用传该数据
         * @appid       appid必须与发模板消息的公众号是绑定关联关系）
         * @pagepath    所需跳转到小程序的具体页面路径，支持带参数,（示例index?foo=bar）
         */
        $data = '{
           "touser":"' . $openid . '",
           "template_id":"' . $templateid . '",
           "url":"http://www.wxwytime.com/index.php?g=Wap&m=Index&a=search&token=lypzib1465694885",
           "miniprogram":{
             "appid":"",
             "pagepath":""
           },
           "data":{
                   "first": {
                       "value":"' . $title . '",
                       "color":"#7A378B"
                   },
                   "keyword1":{
                       "value":"' . $data1 . '",
                       "color":"#787878"
                   },
                   "keyword2": {
                       "value":"' . $data2 . '",
                       "color":"#787878"
                   },
                   "keyword3": {
                       "value":"' . $data3 . '",
                       "color":"#787878"
                   },
                   "remark":{
                       "value":"' . $remark . '",
                       "color":"#C5C1AA"
                   }
           }
       }';
        $send = $this->https_request($url, $data);
        $send = json_decode($send, true);
        return $send;
    }

    public function love($access_token,$openid,$dataday){
        $templateid = 'XybSf8RPbHbs3qEhGxv48-Y_yRsNWx-L7020nTBe7tw';

        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
        /*
         * @miniprogram 跳小程序所需数据，不需跳小程序可不用传该数据
         * @appid       appid必须与发模板消息的公众号是绑定关联关系）
         * @pagepath    所需跳转到小程序的具体页面路径，支持带参数,（示例index?foo=bar）
         */
        $day = $dataday['days'];
        $name = '猪猪';
        $days = $dataday['days'];
        $week = $dataday['week'];
        $salary = '15天';
        $weather = $dataday['weather'];
        $temp_low = $dataday['temp_low'];
        $temp_high = $dataday['temp_high'];
        $message = '元气满满的一天，加油哦！ヾ(◍°∇°◍)ﾉﾞ';

// "url":"http://www.wxwytime.com/index.php?g=Wap&m=Index&a=search&token=lypzib1465694885",
        $data = '{
           "touser":"' . $openid . '",
           "template_id":"' . $templateid . '",
           "url":"",
           "miniprogram":{
             "appid":"",
             "pagepath":""
           },
           "data":{
                   "day": {
                       "value":"' . $day . '",
                       "color":"#7A378B"
                   },
                   "name":{
                       "value":"' . $name . '",
                       "color":"#787878"
                   },
                   "days": {
                       "value":"' . $days . '",
                       "color":"#787878"
                   },
                   "week": {
                       "value":"' . $week . '",
                       "color":"#787878"
                   },
                   "salary":{
                       "value":"' . $salary . '",
                       "color":"#C5C1AA"
                   },
                   "weather":{
                       "value":"' . $weather . '",
                       "color":"#C5C1AA"
                   },
                   "temp_low":{
                       "value":"' . $temp_low . '",
                       "color":"#C5C1AA"
                   },
                   "temp_high":{
                       "value":"' . $temp_high . '",
                       "color":"#C5C1AA"
                   },
                   "message":{
                       "value":"' . $message . '",
                       "color":"#C5C1AA"
                   }
           }
       }';
        $send = $this->https_request($url, $data);
        $send = json_decode($send, true);
        return $send;
    }


    //通用数据处理方法发送模板消息
    public function https_request($url, $data = null) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}
