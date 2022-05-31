<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class WeChatUser extends Model
{
    public $table = 'wechatuser';

    public $fillable = [
        'id',
        'name',
        'openid',
        'avatar'
    ];
}
