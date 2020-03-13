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

namespace app\common\business\bus;

use think\db\exception\DbException;
use app\common\models\mysql\Permission as model;

/***
 * Class Permission
 * @package app\backend\business
 */
class Permission extends BaseBis
{
    public function __construct()
    {
        $this->model = new model();
    }

    /***
     * getAllDataByStatus 获取数据，只要是状态值为传过来的，不分页查询出来
     * 为什么有此方法？
     * @param int $status
     * @return array
     */
    public function getAllDataByStatus(int $status)
    {
        try {
            $result = $this->model::getAllDataByStatus($status);
            return $result->toArray();
        } catch (\Exception $exception) {
            abort(500, "服务器内部错误");
        }
    }

    public function getAllData(int $status = 1)
    {
        try {
            $result = $this->model::getAllData($status);
            return $result->toArray();
        } catch (\Exception $exception) {
            return [];
        }
    }

    public function getParentData(int $status = 1)
    {
        try {
            $result = $this->model::getParentData((int)$status);
            return $result->toArray();
        } catch (\Exception $exception) {
            return [];
        }
    }



    public function getDataById(int $id){
        try{
            return $this->model::find($id);
        }catch (\Exception $exception){
            abort(500,"服务器内部错误!");
        }
    }
}