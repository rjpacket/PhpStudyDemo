<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 20:36
 */

namespace app\common\validate;

use think\Validate;

class Identify extends Validate
{
    protected $rule = [
      'id' => 'require|number|length:11'
    ];
}