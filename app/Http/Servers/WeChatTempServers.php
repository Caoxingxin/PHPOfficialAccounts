<?php


namespace App\Http\Servers;


use App\Factory\TempFactory;

class WeChatTempServers
{
    private $app;
    public function __construct($app)
    {
        $this->app = $app;
    }
    //设置所属行业
    //$industryId1,$industryId2为所属行业代码，详情见https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Template_Message_Interface.html
    public function setIndustry($industryId1,$industryId2){
        $this->app->template_message->setIndustry($industryId1, $industryId2);
    }
    public function addTemp($tempId,$openid){
        $this->app->template_message->addTemplate($tempId);
        //杨秀丽专属
        $data = (new TempFactory())->setTemp('yxl');
        return $this->app->template_message->send([
            'touser'=>$openid,
            'template_id' => $tempId,
            'url'=>'',
            'miniprogram' =>'',
            'scene' => 1000,
            'data' => $data
        ]);
    }
}
