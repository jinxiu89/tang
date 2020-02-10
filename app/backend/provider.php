<?php
/***
 * File Name :provider.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/2/6 下午5:56
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
use app\backend\exception\Exception;//应用异常注入

// 容器Provider定义文件
return [
    'think\exception\Handle' => Exception::class,
];