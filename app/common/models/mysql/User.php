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

/***
 * Class User
 * @package app\common\models\mysql
 */
class User extends BaseModel {
    protected $table='admin_user';

    /***
     * getDataByUserName
     * 根据用户名来获得数据
     * @param string $username
     * @return
     */
    public static function getDataByUserName(string $username){
        return self::where(['username'=>$username])->findOrEmpty();
    }
    /***
     * updateDataByID
     * 根据ID更新数据
     * @param int $id
     * @param array $data
     * @return User
     */
    public static function updateDataByID(int $id,array $data){

        return self::update($data,['id'=>$id]);
    }

    /**
     * @param int $status
     * @return mixed
     * @throws \think\db\exception\DbException
     */
    public static function GetDataByStatS(int $status=1){
        return self::where(['status'=>$status])->order('id', 'desc')->paginate(5);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public static function getDataById(int $id){
        return self::findOrEmpty($id);
    }
}