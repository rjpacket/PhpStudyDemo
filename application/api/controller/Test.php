<?php
namespace app\api\controller;

use think\Controller;

class Test extends Controller
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
        model("ssss");
        exit;
        return show(1, "ok", input('post.'), 200);
    }
}