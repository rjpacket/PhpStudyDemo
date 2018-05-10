<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */

namespace app\common\lib;

use think\Cache;

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

    /**
     * @param array $data
     * @return string
     */
    public static function setSign($data = []){
        //按字段排序
        ksort($data);
        //拼接
        $string = http_build_query($data);
        //加密
        $encrypt = Aes::encrypt($string);
        //uppercase
        return $encrypt;
    }

    /**
     *
     * 校验 sign 是否合法
     * @param $data
     * @return bool
     */
    public static function checkSignPass($data){
        $decrypt = Aes::decrypt($data['sign']);

        if(empty($decrypt)){
            return false;
        }

        parse_str($decrypt, $arr);
//        halt($arr);
        if(!is_array($arr) || empty($arr['did']) || $arr['did'] != $data['did']){
            return false;
        }

        if((time() - ceil($arr['time'] / 1000)) > config('app.app_sign_time')){
            return false;
        }

        //唯一性判断
        if(Cache::get($data['sign'])){
            return false;
        }

        return true;
    }

    /**
     * 设置登录token
     * @param string $phone
     */
    public static function setAppLoginToken($phone = ''){
        $str = md5(uniqid(md5(microtime(true)),true));
        $str = sha1($str.$phone);
        return $str;
    }
}