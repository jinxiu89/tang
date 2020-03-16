<?php
/***
 * File Name :Role.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/3/14 下午3:57
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
declare(strict_types=1);

namespace app\common\business\bus;

use app\common\models\mysql\Role as RoleModel;
use Exception;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

/**
 *
 */
class Role extends BaseBis
{
    public function __construct()
    {
        $this->model = new RoleModel();
    }


    /**
     * @param int $status
     * @return array
     */
    public function getPermissionsByStatus(int $status = 1)
    {
        try {
            $obj = $this->model::getPermissionsByStatus((int)$status);
            return $obj->toArray();
        } catch (Exception $exception) {
            abort(500, '服务器内部错误');
        }
    }

    /**
     * @param string $permissions
     * @return string
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function getPermissionsByIds(string $permissions)
    {
        $ids = explode(',', $permissions);
        $results = $this->model::getPermissionsByIds((array)$ids);
        $permissions = '';
        foreach ($results as $result) {
            $permissions .= $result['name'].' ';
        }
        return $permissions;
    }

    /**
     * @return array
     */
    public function getParent()
    {
        try {
            $obj = $this->model::getParents((int)1);
            return $obj->toArray();
        } catch (Exception $exception) {
            //todo::写错误日志
            abort(500, '服务器内部错误');
        }
    }
}