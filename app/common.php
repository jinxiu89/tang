<?php
/***
* File Name :common.php
* Create by kevin
* Author:jinxiu89@163.com
* Create Date :2020/2/7 下午6:56
* 人生得意需尽欢，莫使金樽空对月。
* 你还记得你吹过的牛逼吗？记住，默默的实现它。
***/
declare(strict_types=1);
/**
* @param int $type
* @param bool $adv
 * @return mixed
 */
function get_client_ip(int $type = 0, bool $adv = false) {
    $type = $type ? 1 : 0;
    static $ip = NULL;
    if ($ip !== NULL)
        return $ip[$type];
    if ($adv) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos)
                unset($arr[$pos]);
            $ip = trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证, 防止通过IP注入攻击
    $long = sprintf("%u", ip2long($ip));
    $ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}