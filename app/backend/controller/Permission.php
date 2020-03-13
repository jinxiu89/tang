<?php
/***
 * File Name :Permission.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/2/11 下午1:38
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
use app\backend\validate\Permission as PermissionValidate;
use app\common\business\bus\Permission as PermissionBis;
use think\response\Json;
use app\common\business\lib\Category;

/***
 * Class Permission
 * @package app\backend\controller
 */
class Permission extends BaseController
{
    protected $validate = null;
    protected $business = null;
    protected $permission_list = null;
    protected $parent=null;

    /***
     * Permission constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->validate = new PermissionValidate();
        $this->business = new PermissionBis();
        $data = $this->business->getAllDataByStatus((int) 1);
        /** @var TYPE_NAME $data */
        $this->permission_list = Category::toLevel($data,'--',0,0);
        $this->parent = $this->business->getParentData();
    }

    public function index()
    {
        if ($this->request->isGet()) {

            return View::fetch('', ['parent' => $this->parent]);
        }
    }

    public function list()
    {
        return json($this->permission_list);
    }

    /**
     * add
     * 异步提交 经过验证后 去存储，存储OK返回json成功结果
     * @return Json
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $data = input('post.', [], 'htmlspecialchars');
            if ($data['pid'] != 0) {
                if (!$this->validate->scene('add_child')->check($data)) {
                    return jsonShow(0, $this->validate->getError());
                }
            } else {
                /** @var TYPcE_NAME $this */
                if (!$this->validate->scene('add_parent')->check($data)) {
                    return jsonShow(0, $this->validate->getError());
                }
            }
            try {
                $result = $this->business->add($data);
                if ($result) {
                    return jsonShow(1, '保存成功');
                }
                return jsonShow(0, '未知错误导致失败', [], 500);
            } catch (Exception $exception) {
                return jsonShow(0, "服务器内部错误");
            }

        }
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function edit()
    {
        if ($this->request->isGet()) {
            $id = input('id', '', 'intval');
            if (!$this->validate->scene('id')->check(['id' => $id])) {
                throw new HttpException(500, $this->validate->getError());
            }
            $result = $this->business->getDataById($id);
            return View::fetch('', ['result' => $result, 'list' => $this->parent]);
        }
        if($this->request->isPost()){
            $data=input('post.',[],'htmlspecialchars');
            if($data['pid'] == $data['id']){
                return jsonShow(0,'权限父级分类不能是他本身',[],500);
            }
            if(!$this->validate->scene('edit')->check($data)){
                abort(500,$this->validate->getError());
            }
            $result=$this->business->save((array) $data);
            if($result){
                return jsonShow(1,'保存成功！');
            }
            return jsonShow(0,'未知原因的错误');
        }
    }
}