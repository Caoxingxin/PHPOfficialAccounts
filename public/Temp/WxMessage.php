<?php
require_once 'dayli.php';
require_once 'Temp.php';

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
    public $appid = 'wx97a715a466d5f47b';
    public $appSecret = 'eaefdc4ed30fe43363d7d5a7a3f9842b';
//    public function __construct($appid = null,$appSecret = null)
//    {
//        $this->appid = $appid;
//        $this->appSecret = $appSecret;
//    }

    public function sendMsg($openid) {

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->appid . "&secret=" . $this->appSecret;
//        //外部日期接口
        $dayli = new dayli();
        $day_data = [
            'app' => 'weather.today',
            'weaId' => '2722',
            'appkey' => '61770',
            'sign' => '8931ac5a17e8428e6b929287d54fe6b0',
            'format' => 'json',
        ];
        $dayli_result = $dayli->nowapi_call($day_data);


        //获取access_token
        $resultData = $this->https_getRequest($url);
        $access_token = $resultData["access_token"];

        //$openid = 'orpdAwprTZvFaUwPDfW4WSanlZIk';

        $temp = new Temp();
        //return $temp->testTemp($access_token,$openid,$dayli_result);
        return $temp->love($access_token,$openid,$dayli_result);
    }

    //发起获得code值链接
    public function GET_Code() {
        $get_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appid;
//        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        $url = "http://124.220.153.66/Temp/WxMessage.php";
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
