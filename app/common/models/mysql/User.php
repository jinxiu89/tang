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
    /***
 * 根据用户名来获得数据
* @param string $username
 * @return array|\think\db\concern\Model
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
}