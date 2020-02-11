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
        'id'=>'require|number',
        'username'=>'require|max:25',
        'password'=>'require',
        'rnd'=>'require|max:8',
        'email'=>'require|email'
    ];
    protected $message=[
        'id.require'=>'ID不能为空',
        'id.number'=>'ID不合法',
        'username.require'=>'名称必须填',
        'username.max'=>'名称最多不能超过25个字符',
        'rnd.require'=>'安全码必须填',
        'rnd.max'=>'安全吗最大不能超过8个字符',
        'email.require'=>'邮箱必须填',
        'email.email'=>'邮箱格式不对',
        ];
    protected $scene=[
        'email'=>['email','password'],
        'name'=>['username','password'],
        'add'=>['username','password','rnd'],
        'edit'=>['id','username','password'],
        'id'=>['id']
        ];
}