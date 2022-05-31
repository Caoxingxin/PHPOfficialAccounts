<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/message', 'Wxmessage@message');
Route::any('/wechat', 'WeChatController@serve');
Route::get('/wechat/menu', 'WeChatController@menu');
Route::group(['middleware' => ['web', 'wechat.oauth:default,snsapi_userinfo']], function () {
    Route::get('/user', 'WeChatController@userData');
});
