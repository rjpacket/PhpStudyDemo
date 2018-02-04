<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */

namespace app\common\lib;

/**
 * Class IAuth
 * @package app\common\lib
 */
class IAuth
{
    /**
     * set password
     * @param $data
     * @return string
     */
    public static function setPassword($data){
        return md5($data.config('app.password_pre_halt'));
    }
}