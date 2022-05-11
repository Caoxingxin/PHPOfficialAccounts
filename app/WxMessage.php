<?php


namespace App;


header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Shanghai");

$temp = new WxMessage();
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
    if (!empty($_GET['code'])) {
        $openid = $temp->GetOpenid();
        if ($openid) {
            $result = $temp->sendMsg($openid);
            if ($result['errmsg'] == 'ok') {
                echo '<script>alert("发送成功!");</script>';
            } else {
                echo '发送失败!' . $result['errmsg'];
            }
        } else {
            echo '<script>alert("获取openID失败!");</script>';
        }
    } else {
        $temp->GET_Code();
    }
} else {
    echo '<script>alert("发送模板需要先获取openID!");</script>';
    $openid='orpdAwprTZvFaUwPDfW4WSanlZIk';
    $result = $temp->sendMsg($openid);
    if ($result['errmsg'] == 'ok') {
        echo '<script>alert("发送成功!");</script>';
    } else {
        echo '发送失败!' . $result['errmsg'];
    }
}

class WxMessage
{
    public $appid = 'wx0918cc3e8dac5d76';
    public $appSecret = '81e68a85884e639c763424d4089d78d7';
//    public function __construct($appid = null,$appSecret = null)
//    {
//        $this->appid = $appid;
//        $this->appSecret = $appSecret;
//    }

    public function sendMsg($openid) {

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->appid . "&secret=" . $this->appSecret;
        //获取access_token
        $resultData = $this->https_getRequest($url);
        $access_token = $resultData["access_token"];

        //$openid = 'orpdAwprTZvFaUwPDfW4WSanlZIk';
        $templateid = 'WU1kZKhfBrAuhEF0M4viN3E5UmiCC_5bfE0oGeR2Utk';
        $title = "模板消息发送成功！";
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
                   "day": {
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

    //发起获得code值链接
    public function GET_Code() {
        $get_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appid;
//        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        $url = "http://2pgq2b.natappfree.cc/Temp/WxMessage.php";
        var_dump($url);
        header("location:" . $get_url . "&redirect_uri=" . $url . "&response_type=code&scope=snsapi_base&state=1#wechat_redirect");
    }

    //获取用户openid
    public function GetOpenid() {
        $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->appid . '&secret=' . $this->appSecret . '&code=' . $_GET['code'] . '&grant_type=authorization_code';
        $json_obj = $this->https_getRequest($get_token_url);
        // $access_token = $json_obj['access_token'];
        return $json_obj['openid'];
    }

    /*
     * 获取数据
     */

    public function https_getRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $jsonData = json_decode($output, true);
        return $jsonData;
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
