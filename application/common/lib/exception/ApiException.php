<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/19
 * Time: 22:17
 */

namespace app\common\lib\exception;
use think\Exception;

class ApiException extends Exception{
    public $message = '';
    public $httpcode = 500;
    public $code = 0;

    public function __construct($message = "", $httpcode = 0, $code = 0)
    {
        $this -> message = $message;
        $this -> httpcode = $httpcode;
        $this -> code = $code;

    }
}