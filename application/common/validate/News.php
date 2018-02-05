<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/4
 * Time: 22:08
 */

namespace app\common\validate;


use think\Validate;

class News extends Validate
{
    protected $rule = [
        'title' => 'require|max:40',
        'small_title' => 'require|max:40',
        'catid' => 'require',
        'description' => 'require',
        'content' => 'require'
    ];
}