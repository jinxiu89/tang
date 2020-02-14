<?php
/***
* File Name :PermissionGroup.php
* Create by kevin
* Author:jinxiu89@163.com
* Create Date :2020/2/11 下午10:27
* 人生得意需尽欢，莫使金樽空对月。
* 你还记得你吹过的牛逼吗？记住，默默的实现它。
***/
declare(strict_types=1);

namespace app\common\models\mysql;


use think\Model;
class PermissionGroup extends Model {
    protected $table="permission_group";

    public static function getDataByName(){

    }
    public static function getDataByStatus(int $status){
        return self::where(['status'=>$status])->order('id desc')->paginate(5);
    }
}