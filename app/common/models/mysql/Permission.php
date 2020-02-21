<?php
/***
 * File Name :Permission.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/2/11 下午10:27
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
declare(strict_types=1);

namespace app\common\models\mysql;


use think\Model;

/**
 * Class Permission
 * @package app\common\models\mysql
 */
class Permission extends Model
{
    protected $table = "permission";

    public static function getDataByName()
    {

    }

    public static function getDataByStatus(int $status)
    {
        return self::where(['status' => $status])->order(['pid'=>'desc'])->select();
    }

    public static function getAllData(int $status)
    {
        return self::where(['status' => $status])->field('id,name')->order('id desc')->select();
    }

    public static function getParentData(int $status)
    {
        return self::where(['status' => $status, 'pid' => 0])->field('id,name')->order('id desc')->select();
    }
}