<?php
/***
* File Name :User.php
* Create by kevin
* Author:jinxiu89@163.com
* Create Date :2020/2/6 下午9:37
* 人生得意需尽欢，莫使金樽空对月。
* 你还记得你吹过的牛逼吗？记住，默默的实现它。
***/
declare(strict_types=1);
namespace app\backend\validate;
use think\Validate;
class User extends Validate{
    protected $rule=[
        'name'=>'require|max:25',
        'password'=>'require',
        'email'=>'email'
    ];
    protected $message=[
        'name.require'=>'名称必须填',
        'name.max'=>'名称最多不能超过25个字符',
        'email'=>'邮箱格式不对',
        ];
    protected $scene=[
        'email'=>['email','password'],
        'name'=>['name','password']
        ];
}