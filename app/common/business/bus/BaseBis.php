<?php
/***
 * File Name :BaseModel.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/3/13 下午7:27
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
declare(strict_types=1);

namespace app\common\business\bus;

/***
 * Class BaseModel
 * @package app\backend\business
 */
class BaseBis
{
    protected $model;

    /***
     * @param array $data
     * @return mixed
     */
    public function add(array $data)
    {
        try {
            $result = $this->model::create($data);
            return $result->id;
        } catch (\Exception $exception) {
            abort(500, "服务器内部异常");
        }
    }

    /*
     * save 通用跟新保存
     * @param array $data
     * @return mixed
     * 准备废弃代码
     */
    /**
    public function save(array $data)
    {
        try {
            $result = $this->model::update($data, ['id' => $data['id']]);
            return $result->id;
        } catch (\Exception $exception) {
            abort(500, "服务器内部错误");
        }
    }
    */

    /***
     *
     * update
     * 用户提交后台
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        try {

            $upResult = $this->model::update((array)$data,(int) $data['id']);
            if ($upResult->isEmpty()) {
                return false;
            }
            return true;
        } catch (\Exception $exception) {//数据库错误时会出发该异常
            abort(500, "服务器内部异常");
        }
        return false;
    }

    /**
     * @param int $status
     * 根据状态值查询出数据
     * @return mixed
     */
    public function GetDataByStatus(int $status)
    {
        try {
            $obj = $this->model::GetDataByStatus((int)$status);
            return $obj->toArray();
        } catch (\Exception $exception) {
            abort(500, '服务器内部错误');
        }
    }

    /**
     * getDataByIdgetDataById
     * 根据ID获取数据
     * @param int $id
     * @return mixed
     */
    public function getDataById(int $id)
    {
        try {
            return $this->model::getDataById($id);
        } catch (\Exception $exception) {
            abort(500, "服务器内部错误!");
        }
    }
}