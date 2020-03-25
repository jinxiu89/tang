<?php
/***
 * File Name :BaseModel.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/3/13 下午7:37
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
declare(strict_types=1);

namespace app\common\models\mysql;

use think\db\exception\DbException;
use think\Model;

/***
 * Class BaseModel
 *
 * @package app\common\models\mysql
 */
class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;
    protected $model;

    /***
     * @param array $data
     * @return mixed
     */
    public function add(array $data)
    {
        try {

            $result = self::create($data);
            return $result->id;
        } catch (\Exception $exception) {
            abort(500, "服务器内部错误");
        }
    }

    /**
     * GetDataByStatS 根据状态来获取列表数据
     * @param int $status
     * @return mixed
     * @throws DbException
     */
    public static function GetDataByStatus(int $status = 1)
    {
        return self::where(['status' => $status])->order('id', 'desc')->paginate(5);
    }

    /***
     * updateDataByID 根据ID更新数据
     *
     * @param int $id
     * @param array $data
     * @return BaseModel
     */
    public static function updateDataByID(int $id, array $data)
    {

        return self::update($data, ['id' => $id]);
    }

    /**
     * getDataById 根据ID来获取数据
     * 公共查询 通过ID查询数据
     * @param int $id
     * @return mixed
     */
    public static function getDataById(int $id)
    {
        return self::findOrEmpty($id);
    }
}