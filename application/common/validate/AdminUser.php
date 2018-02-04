<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 20:36
 */

namespace app\common\validate;

use think\Validate;

class AdminUser extends Validate
{
    protected $rule = [
      'username' => 'require|max:20',
      'password' => 'require|max:20'
    ];
}