<?php
/***
* File Name :User.php
* Create by kevin
* Author:jinxiu89@163.com
* Create Date :2020/2/6 下午10:11
* 人生得意需尽欢，莫使金樽空对月。
* 你还记得你吹过的牛逼吗？记住，默默的实现它。
***/
declare(strict_types=1);

namespace app\common\models\mysql;
use think\Model;

class User extends Model{
    protected $table='admin_user';
    public static function getDataByUserName(string $username){
        return (new self())->where(['username'=>$username])->findOrEmpty();
    }
}