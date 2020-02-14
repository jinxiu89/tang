<?php
/***
 * File Name :Http.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/2/2 上午8:12
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
declare(strict_types=1);

namespace app\backend\exception;

use think\exception\Handle;
use think\exception\ValidateException;
use think\exception\HttpException;
use think\Response;
use Throwable;

class Exception extends Handle
{
    protected $httpStatus = 500;

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        /*if($e instanceof ValidateException){
            //
        }*/
        //如果异常由Http异常抛出，还是ajax/post请求，就使用json数据抛出
        if ($e instanceof HttpException && $request->isPost()) {
            return jsonShow(0, $e->getMessage(), [], $e->getStatusCode());
        }
        return parent::render($request, $e);
    }
}