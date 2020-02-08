<?php
namespace app\backend\controller;

use app\BaseController;use think\facade\View;

class Index extends BaseController
{
    public function index()
    {

        if($this->request->isGet()){
            return View::fetch();
        }
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}
