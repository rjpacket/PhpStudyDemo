<?php
namespace app\common\lib\exception;
use think\exception\Handle;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/19
 * Time: 0:33
 */

class ApiExceptionHandle extends Handle
{
    public $httpcode = 500;

    public function render(\Exception $e)
    {
        return show(0, $e->getMessage(), [], $this->httpcode);
    }
}