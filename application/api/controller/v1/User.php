<?php

namespace app\api\controller\v1;

use think\Exception;

class User extends AuthBase
{
    public function read(){
        return show(1, "ok", $this -> user, 200);
    }

    public function update(){
        $postData = input('param.');
        //validate 校验

        $data = [];
        if(!empty($postData['image'])){
            $data['image'] = $postData['image'];
        }
        if(!empty($postData['username'])){
            $data['username'] = $postData['username'];
        }
        if(!empty($postData['sex'])){
            $data['sex'] = $postData['sex'];
        }

        if(empty($data)){
            return show(0, '数据不合法', [], 404);
        }

        try {
            $id = model('User')->save($data, ['id' => $this->user->id]);
            if ($id) {
                return show(1, "ok", [], 200);
            } else {
                return show(0, '修改失败', [], 401);
            }
        }catch (\Exception $e){
            return show(0, '数据库操作失败', [], 404);
        }
    }
}