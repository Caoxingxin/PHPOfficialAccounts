<?php


namespace App\Http\Servers;


class WeChatMenuServers
{
    public function createMenu($app){
        $buttons = [
            [
                "type" => "view",
                "name" => "今日穿搭",
                "url"  => "https://www.d5168.com/wuhang/"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
            [
                "type" => 'view',
                "name" => '博客',
                'url' => 'https://www.ruanyifeng.com/blog/'
            ]
        ];
        return $app->menu->create($buttons);
    }
}
