<?php
/***
 * File Name :Role.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/3/14 下午3:15
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
declare(strict_types=1);

namespace app\backend\controller;


use app\BaseController;
use think\App;
use think\facade\View;
use app\common\business\bus\Role as RoleBis;
use app\backend\validate\Role as RoleValidate;
/**
 * Class Role
 * @package app\backend\controller
 */
class Role extends BaseController
{
    protected $validate = null;
    protected $business = null;
    /**
     * Role constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->business=new RoleBis();
        $this->validate= new RoleValidate();
    }

    /**
     *
     */
    public function index(){
        if($this->request->isGet()){
            $result=$this->business->GetDataByStatus((int) 1);
            $data=$result['data'];
            unset($result['data']);
            foreach ($data as &$item){
                $item['permission']=$this->business->getPermissionsByIds((string) $item['permissions']);
            }
            return View::fetch('',[
                'data'=>$data,
                'page'=>$result,
            ]);
        }
    }

    public function add(){
        if($this->request->isGet()){
            //列出所有权限
            $permissions=$this->business->getPermissionsByStatus();
            $parent=$this->business->getParent();
            return View::fetch('',[
                'parent'=>$parent,
                'permissions'=>$permissions
            ]);
        }
        if($this->request->isPost()){
            $data=input('post.',[],'htmlspecialchars');
            if(!$this->validate->scene('add_role')->check($data)){
                abort(500,$this->validate->getError());
            }
            $permissionsIds=implode(',',$data['permissions']);
            unset($data['permissions']);
            $data['permissions']=$permissionsIds;
            $result=$this->business->add((array) $data);
            if($result){
                return jsonShow(1,'保存成功！');
            }
            return jsonShow(0,'未知原因的错误');
        }
    }
}