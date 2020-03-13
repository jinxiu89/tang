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

use think\Model;

/***
 * Class BaseModel
 *
 * @package app\common\models\mysql
 */
class BaseModel extends Model
{
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

}