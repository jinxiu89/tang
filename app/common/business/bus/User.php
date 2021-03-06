<?php
/***
 * File Name :User.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/2/6 下午9:34
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
declare(strict_types=1);

namespace app\common\business\bus;

use app\common\models\mysql\User as UserModel;
use think\facade\Session;

/**
 * Class User
 * @package app\backend\business
 */
class User extends BaseBis
{
    /***
     * User constructor.
     */
    public function __construct()
    {
        $this->model = new UserModel();
    }

    /***
     * 登录业务逻辑
     ** 升级 通过异常来捕获错误，而不采用状态值传递至控制器层
     * @param array $data
     * @return bool
     */
    public function login(array $data)
    {
        $User = $this->model::getDataByUserName($data['username']);
        if ($User->isEmpty()) {
            abort(500, "用户不存在");
        }
        if (md5($data['password'] . $User->salt) != $User->password) {
            abort(500, "密码不正确");
        }
        //更新登录数据
        $upData = ['login_num' => $User->login_num + 1, 'last_ip' => get_client_ip(), 'last_login' => time()];
        //更新
        try {
            $upResult = $this->model::updateDataByID($User->id, $upData);
            if ($upResult->isEmpty()) {
                abort(500, '登录失败，内部数据异常');
            }
            //写入session,这里写session 异常待处理
            Session::set('adminUser', ['id' => $User->id, 'username' => $User->username]);
            return true;
        } catch (\Exception $exception) {//数据库错误时会出发该异常
            abort(500, "服务器内部异常");
        }
        return false;
    }


    /**
     * GetNormalData
     * 获得正常的用户数据列表
     */
//    public function GetDataByStatus()
//    {
//        try{
//            $obj = UserModel::GetDataByStatS();
//            return $obj->toArray();
//        }catch (\Exception $exception){
//            return [];
//        }
//    }


    public function getData(int $id)
    {
        $obj = UserModel::getDataById((int)$id);
        return $obj->toArray();
    }
}