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
    Route::get('/login', 'User/login')->name('login');
})->prefix('backend/');

Route::group('user', function () {
    Route::rule('/list', 'User/index', 'GET')->name('user_list');
    Route::rule('/add', 'User/add', 'GET|POST')->name('user_add');
    Route::rule('/edit/:id', 'User/edit', 'GET|POST')->name('user_edit')->pattern(['id' => '\d+']);
    //权限
    Route::rule('/permission/list', 'Permission/list', 'GET')->name('permission_list');
    Route::rule('/permission', 'Permission/index', 'GET')->name('permission');
    Route::rule('/add_permission', 'Permission/add', 'POST')->name('add_permission');
})->middleware(Auth::class);
/**
 * Route
 * 后台需要认证的路由分组，每条路由都有一个name（）,在后面的url生成时非常有用
 */
Route::group('/', function () {
    Route::get('index', 'Index/index')->name('index');
    Route::get('welcome', 'Index/welcome')->name('welcome');
})->prefix('backend/')->middleware(Auth::class);