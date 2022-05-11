<?php
require_once 'Temp/WxMessage.php';
define("TOKEN", "caoxinxin");//自己定义的token 就是个通信的私钥
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();
//$wechatObj->responseMsg();
class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            ob_clean();
            echo $echoStr;
            exit;
        }
    }
    public function responseMsg()
    {
//        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postStr = file_get_contents('php://input');
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <FuncFlag>0<FuncFlag>
            </xml>";
            if(!empty( $keyword ))
            {
                if (strstr($keyword, '养')){

                    $imagePath = "http://yjz8gd.natappfree.cc/image/yangsheng1.jpg";
                    $path = "http://www.18ys.cn/";
                    $title = '养生常识';
                    $des = '日常生活的各种规范饮食和作息';
                    $item = "<item>
                          <Title><![CDATA[%s]]></Title>
                          <Description><![CDATA[%s]]></Description>
                          <PicUrl><![CDATA[%s]]></PicUrl>
                          <Url><![CDATA[%s]]></Url>
                        </item>";
                    $item_str = sprintf($item,$title,$des,$imagePath,$path);

                    $textTpl ="<xml>
                      <ToUserName><![CDATA[%s]]></ToUserName>
                      <FromUserName><![CDATA[%s]]></FromUserName>
                      <CreateTime>%s</CreateTime>
                      <MsgType><![CDATA[%s]]></MsgType>
                      <ArticleCount>%s</ArticleCount>
                      <Articles>
                       $item_str
                      </Articles>
                    </xml>
                    ";
                    $msgType = "news";
                    $count = 1;
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$count);
                    echo $resultStr;
                }elseif(strstr($keyword, '日常')){
//                    $msgType = "text";
//                    $contentStr = '渣的我';
//                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
//                    echo $resultStr;
                  //  $this->toDay();
                    $url = "http://yjz8gd.natappfree.cc/Temp/WxMessage.php";
                    $ch = curl_init();
                    $timeout = 5;
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                    $contents = curl_exec($ch);
                    curl_close($ch);
                    echo $contents;
                }else{
                    $msgType = "text";
                    $contentStr = '你好啊，亲爱的';
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }

            }else{
                echo '咋不说哈呢';
            }
        }else {
            echo '咋不说哈呢2';
            //exit;
        }
    }
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token =TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function toDay(){
        //$wxmessage = new WxMessage('wxcdafe0d798114f2c','b865da154b0e66647d420e8f8d554718');
        //$wxMessage = new \WxMessage();
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
    }
}
?>
