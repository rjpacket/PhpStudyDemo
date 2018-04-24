<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 22:51
 */

namespace app\common\lib;

/**
 * Class Time
 * @package app\common\lib
 */
class Time
{
    /**
     * 时间
     * @return string
     */
    public static function get13TimeStamp(){
        list($t1, $t2) = explode(' ', microtime());
        return $t2 . ceil($t1 * 1000);
    }
}