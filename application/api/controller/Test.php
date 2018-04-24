<?php
namespace app\api\controller;

use app\common\lib\exception\ApiException;
use think\Controller;

class Test extends Common
{
    public function index()
    {
        return [
            "abssas",
            "34534563",
            "5867tututu"
        ];
    }


    public function update($id = 0)
    {
        $id = input('put.id');
        return $id;
    }

    public function save(){
        $data = input('post.');
        if($data['mt'] != 1){
//            exception("您提交的数据不合法");
            throw new ApiException('您提交的数据不合法欧', 403);
        }
        return show(1, "ok", input('post.'), 200);
    }
}