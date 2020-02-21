<?php
/***
* File Name :Permission.php
* Create by kevin
* Author:jinxiu89@163.com
* Create Date :2020/2/11 下午10:14
* 人生得意需尽欢，莫使金樽空对月。
* 你还记得你吹过的牛逼吗？记住，默默的实现它。
***/
declare(strict_types=1);

namespace app\backend\validate;


use think\Validate;
class Permission extends Validate {
    protected $rule=[
        'id'=>'require|number',
        'name'=>'require|max:25',
        'handler'=>'require|max:64'
    ];
    protected $message=[
        'id.require'=>'ID必须填写',
        'id.number'=>'ID不合法',
        'name.require'=>'权限名称必须填',
        'name.max'=>'权限名最长不能超过25个字符',
        'handler.require'=>'非顶级分类时,必须填',
        'handler.max'=>'handler限制在64个字符以下',
    ];
    protected $scene=[
        'add_parent'=>['name'],
        'add_child'=>['name','handler'],
        'edit_parent'=>['id','name'],
        'edit_child'=>['id','name','handler'],
        'id'=>['id'],
    ];
}