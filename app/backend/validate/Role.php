<?php
/***
 * File Name :Role.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/3/14 下午5:49
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
declare(strict_types=1);

namespace app\backend\validate;


use think\Validate;

/**
 * Class Role
 * @package app\backend\validate
 */
class Role extends Validate
{
    protected $rule=[
        'id'=>'require|number',
        'name'=>'require|max:32',
        'description'=>'max:255',
    ];
    protected $message=[
        'id.require'=>'ID必须填写',
        'id.number'=>'ID不合法',
        'name.require'=>'权限名称必须填',
        'name.max'=>'权限名最长不能超过32个字符',
        'description.max'=>'description 不能超过255'
    ];
    protected $scene=[
        'id'=>['id'],
        'add_role'=>['name','description'],
        'edit_role'=>['id','name','description']
    ];
}