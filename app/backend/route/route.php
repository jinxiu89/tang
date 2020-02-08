<?php
/***
 * File Name :app.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/2/6 下午5:44
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
use think\facade\Route;
use app\backend\middleware\Auth;
/**
 * 后台用户模块部分的路由分组
 */
Route::group('user', function () {
    Route::get('/login','User/login');
})->prefix('backend/');
//
Route::group('/',function (){
    Route::get('dashboard','Index/index');
})->prefix('backend/')->middleware(Auth::class);