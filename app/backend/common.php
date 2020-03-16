<?php
/***
 * File Name :common.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/2/6 下午5:56
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
 declare(strict_types=1);
 use think\response\Json;
 /***
* @param int $status
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

/**
 * @param array $permissions
 */
function getPermissions(array $permissions){

}