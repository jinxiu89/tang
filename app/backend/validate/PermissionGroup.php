<?php
/***
* File Name :PermissionGroup.php
* Create by kevin
* Author:jinxiu89@163.com
* Create Date :2020/2/11 下午10:14
* 人生得意需尽欢，莫使金樽空对月。
* 你还记得你吹过的牛逼吗？记住，默默的实现它。
***/
declare(strict_types=1);

namespace app\backend\validate;


use think\Validate;
class PermissionGroup extends Validate {
    protected $rule=[
        'id'=>'require|number',
        'name'=>'require|max:25',
    ];
    protected $message=[
        'id.require'=>'ID必须填写',
        'id.number'=>'ID不合法',
        'name.require'=>'分类名称必须填',
        'name.max'=>'分类名最大不能超过25个字符'
    ];
    protected $scene=[
        'add'=>['name'],
        'edit'=>['id','name']
    ];
}