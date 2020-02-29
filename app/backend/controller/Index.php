<?php

namespace app\backend\controller;

use app\BaseController;
use think\App;
use think\facade\View;

class Index extends BaseController
{
    public function index()
    {


        if ($this->request->isGet()) {
            return View::fetch();
        }
    }

    public function welcome()
    {
        if ($this->request->isGet()) {//todo:: 后期仪表盘里的数据在这里读取
            return View::fetch();
        }
    }
    
}
