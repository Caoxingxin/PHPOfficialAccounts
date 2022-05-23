<?php


namespace App\Factory;


use EasyWeChat\Kernel\Messages\Article;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use EasyWeChat\Kernel\Messages\Text;

class MessageTypeFactory
{
    public function changeType($Type){
        switch ($Type){
            case 'text':
                //文本消息
                return new Text('你好，使用Text文本类');
                break;
            case 'news':
                //图文消息
                $news = new NewsItem([
                    'title' => '养生常识',
                    'description' => '日常生活的各种规范饮食和作息',
                    'url' => 'http://www.18ys.cn/',
                    'image' => 'http://124.220.153.66/image/yangsheng1.jpg'
                ]);
                return new News([$news]);
                break;
        }
    }
}
