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
namespace app\backend\business;
use app\common\models\mysql\User as UserModel;

class User {
    public function check(array $data){
        $User=UserModel::getDataByUserName($data['username']);
        if($User->isEmpty()){
           return ['status'=>0,'message'=>'用户不存在'];
        }
        if($User->password !=$data['password']){
            return ['status'=>0,'message'=>'密码不正确'];
        }
        return ['status'=>1,'message'=>'登录成功','data'=>['id'=>$User->id,'username'=>$User->username]];
    }
}