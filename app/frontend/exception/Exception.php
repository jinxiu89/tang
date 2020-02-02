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
namespace app\frontend\exception;

use think\exception\Handle;
use think\Response;
use Throwable;

class Exception extends Handle
{
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
        // 添加自定义异常处理机制

        // 其他错误交给系统处理
        return parent::render($request, $e);
    }
}