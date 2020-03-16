<?php
/***
 * File Name :Role.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/3/14 下午3:58
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
declare(strict_types=1);

namespace app\common\models\mysql;


use think\Collection;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\Model;

class Role extends BaseModel
{
    protected $table = 'role';

    /**
     * @param int $status
     * @return Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getPermissionsByStatus(int $status)
    {
        return Permission::getAllDataByStatus((int)$status);
    }

    /**
     * @param array $ids
     * @return Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getPermissionsByIds(array $ids)
    {
        return Permission::getDataByIds((array)$ids);
    }

    /**
     * @param int $status
     * @return Collection|Model
     */
    public static function getParents(int $status)
    {
        return Permission::getParentData((int)$status);
    }
}