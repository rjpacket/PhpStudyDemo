<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Base
{
    public function index()
    {
//        halt(session(config('')));
        return $this -> fetch();
    }

    public function welcome()
    {
        return "hello world!";
    }
}
