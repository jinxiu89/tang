<?php
declare(strict_types=1);
/***
 * File Name :commmons.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/2/1 下午10:44
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/

use think\response\Json;

/***
 * 通用化API格式的数据
 * 返回数据有几种格式，前后台隔离开发最常见的就是json格式的数据
 * 这个文件也采用了严格模式，后面所有的新开文件都采用严格模式
 * 利用tp的内置json函数输出理想的数据
 * @param $status
 * @param string $message
 * @param array $data
 * @param int $httpStatus
 * @return Json
 */
function jsonShow(int $status,string $message="error",array $data=[],int $httpStatus=200):Json{
    $result=[
        'status'=>$status,
        'message'=>$message,
        'result'=>$data
    ];
    return json($result,$httpStatus);
}