<?php
/***
* File Name :PermissionGroup.php
* Create by kevin
* Author:jinxiu89@163.com
* Create Date :2020/2/11 下午10:14
* 人生得意需尽欢，莫使金樽空对月。
* 你还记得你吹过的牛逼吗？记住，默默的实现它。
***/
declare(strict_types=1);

namespace app\backend\business;
use think\db\exception\DbException;
use app\common\models\mysql\PermissionGroup as model;

class PermissionGroup {
    protected $model=null;
    public function __construct() {
        $this->model=new model();
    }
    public function getDataByStatus(int $status){
        try{
            $result=$this->model->getDataByStatus($status);
            return $result->toArray();
        }catch (\Exception $exception){
            abort(500,"服务器内部错误");
        }
    }
    public function add(array $data){
        try{
            $result=$this->model::create($data);
            return $result->id;
        }catch (\Exception $exception){
            abort(500,"服务器内部错误");
        }
    }
}