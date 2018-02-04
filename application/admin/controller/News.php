<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 22:31
 */

namespace app\admin\controller;


class News extends Base
{
    public function add()
    {
        return $this->fetch('', [
            'cats' => config('Cat.lists')
        ]);
    }
}