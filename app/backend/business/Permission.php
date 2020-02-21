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

namespace app\backend\business;

use think\db\exception\DbException;
use app\common\models\mysql\Permission as model;

/***
 * Class Permission
 * @package app\backend\business
 */
class Permission
{
    protected $model = null;

    public function __construct()
    {
        $this->model = new model();
    }

    /***
     * @param int $status
     * @return array
     */
    public function getDataByStatus(int $status)
    {
        try {
            $result = $this->model->getDataByStatus($status);
            return $result->toArray();
        } catch (\Exception $exception) {
            abort(500, "服务器内部错误");
        }
    }

    public function getAllData(int $status = 1)
    {
        try {
            $result = $this->model->getAllData($status);
            return $result->toArray();
        } catch (\Exception $exception) {
            return [];
        }
    }

    public function getParentData(int $status = 1)
    {
        try {
            $result = $this->model->getParentData((int)$status);
            return $result->toArray();
        } catch (\Exception $exception) {
            return [];
        }
    }

    public function add(array $data)
    {
        try {
            $result = $this->model::create($data);
            return $result->id;
        } catch (\Exception $exception) {
            abort(500, "服务器内部错误");
        }
    }
    public function save(array $data){
        try{
            $result=$this->model::update($data);
            return $result->id;

        }catch (\Exception $exception){
            abort(500,"服务器内部错误");
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