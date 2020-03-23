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
use Exception;
use think\App;
use think\exception\HttpException;
use think\facade\View;
use app\common\business\bus\Role as RoleBis;
use app\backend\validate\Role as RoleValidate;
use think\response\Json;

/**
 * Class Role
 * @package app\backend\controller
 */
class Role extends BaseController
{
    protected $validate = null;
    protected $business = null;
    protected $permissions;
    protected $parent;
    /**
     * Role constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->business=new RoleBis();
        $this->validate= new RoleValidate();
        $this->permissions=$this->business->getPermissionsByStatus();
        $this->parent=$this->business->getParent();
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

    /**
     * @return string|Json
     * @throws Exception
     */
    public function add(){
        if($this->request->isGet()){
            //列出所有权限

            return View::fetch('',[
                'parent'=>$this->parent,
                'permissions'=>$this->permissions
            ]);
        }
        if($this->request->isPost()){
            $data=input('post.',[],'htmlspecialchars');
            if(!$this->validate->scene('add_role')->check($data)){
                abort(500,$this->validate->getError());
            }
            $data['permissions']=implode(',',$data['permissions']);
            $result=$this->business->add((array) $data);
            if($result){
                return jsonShow(1,'保存成功！');
            }
            return jsonShow(0,'未知原因的错误');
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    public function edit(){
        if($this->request->isGet()){
            $id = input('id', '', 'intval');
            if (!$this->validate->scene('id')->check(['id' => $id])) {
                throw new HttpException(500, $this->validate->getError());
            }
            $result=$this->business->getDataById((int) $id)->toArray();
            $result['permissions']=explode(',',$result['permissions']);
            return View::fetch('',[
                'result'=>$result,
                'parent'=>$this->parent,
                'permissions'=>$this->permissions]);
        }
        if($this->request->isPost()){
            //todo::保存操作
            $data=input('post.',[],'htmlspecialchars');
            if(!$this->validate->scene('edit_role')->check($data)){
                abort(500,$this->validate->getError());
            }
            $data['permissions']=implode(',',$data['permissions']);
            $result=$this->business->update($data);
            if($result){
                return jsonShow(1,'保存成功！');
            }
            return jsonShow(0,'未知原因的错误');
        }
    }
}