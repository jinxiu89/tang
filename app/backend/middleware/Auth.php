<?php
/***
 * File Name :Auth.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/2/6 下午6:00
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/
declare(strict_types=1);
namespace app\backend\middleware;


use think\facade\Session;
use think\facade\Request;
class Auth{
    /***
     * @param $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request,\Closure $next){
        $next_jump=Request::header('Referer') ?? url('index');
        if(!Session::get('adminUser','')){
            return redirect('/backend/user/login?next='.$next_jump);
        }
        return $next($request);
    }
}