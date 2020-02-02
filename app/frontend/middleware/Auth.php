<?php
declare(strict_types=1);
namespace app\frontend\middleware;
/***
 * File Name :Auth.php
 * Create by kevin
 * Author:jinxiu89@163.com
 * Create Date :2020/2/2 下午6:13
 * 人生得意需尽欢，莫使金樽空对月。
 * 你还记得你吹过的牛逼吗？记住，默默的实现它。
 ***/

class Auth{
    /***
     * @param $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request,\Closure $next){
        dump(1);
        return $next($request);
    }
}