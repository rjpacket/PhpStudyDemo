<?php
namespace app\admin\controller;

use app\common\lib\IAuth;
use think\Controller;

class Admin extends Base
{
    public function add(){
        if(request() -> isPost()){
//            dump(input('post.'));
            $data = input('post.');

            $validate = validate('AdminUser');
            if(!$validate -> check($data)){
                $this -> error($validate -> getError());
            }

            $data['password'] = IAuth::setPassword($data['password']);
            $data['status'] = 1;

            try {
                $id = model('AdminUser') -> add($data);
            }catch (\Exception $e){
                $this -> error($e -> getMessage());
            }
            if($id){
                $this -> success("id=".$id."用户插入成功。");
            }
        }else {
            return $this->fetch();
        }
    }
}
