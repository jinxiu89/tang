<?php
/***
 * File Name :PermissionGroup.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/2/11 下午1:38
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
declare(strict_types=1);

namespace app\backend\controller;


use app\BaseController;
use think\App;
use think\facade\View;
use app\backend\validate\PermissionGroup as PermissionGroupValidate;
use app\backend\business\PermissionGroup as PermissionGroupModel;

/***
 * Class PermissionGroup
 * @package app\backend\controller
 */
class PermissionGroup extends BaseController
{
    protected $validate = null;
    protected $business = null;

    /***
     * PermissionGroup constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->validate = new PermissionGroupValidate();
        $this->business = new PermissionGroupModel();
    }

    public function index()
    {
        if ($this->request->isGet()) {
            $data = $this->business->getDataByStatus((int)1);
            return View::fetch('', ['data' => $data]);
        }
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $data = input('post.', [], 'htmlspecialchars');
            if (!$this->validate->scene('add')->check($data)) {
                return jsonShow(0, $this->validate->getError());
            }
            try {
                $result = $this->business->add($data);
                if ($result) {
                    return jsonShow(1, '保存成功');
                }
                return jsonShow(0, '未知错误导致失败', [], 500);
            } catch (\Exception $exception) {
                return jsonShow(0, "服务器内部错误");
            }

        }
    }
}