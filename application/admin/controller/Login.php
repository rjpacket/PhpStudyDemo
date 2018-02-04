<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 21:32
 */

namespace app\admin\controller;


use app\common\lib\IAuth;
use think\Controller;

class Login extends Base
{
    public function _initialize()
    {

    }

    public function index(){
        //如果已经登陆了，跳转首页
        $isLogin = $this->isLogin();
        if($isLogin){
            return $this->redirect('index/index');
        }
        return $this -> fetch();
    }

    public function check(){
        if(request() -> isPost()) {
            $data = input("post.");
//            if (!captcha_check($data["code"])) {
//                $this->error("验证码不正确");
//            }

            try {
                $user = model('AdminUser') -> get(['username' => $data['username']]);
                if (!$user || $user -> status != config('Code.status_normal')) {
                    $this->error("cannot find user");
                }

                if (IAuth::setPassword($data['password']) != $user['password']) {
                    $this->error("password error");
                }

                //更新数据库
                $udata = [
                    'last_login_time' => time(),
                    'last_login_ip' => request()->ip()
                ];

                model('AdminUser')->save($udata, ['id' => $user->id]);
            }catch (\Exception $e){
                $this -> error($e -> getMessage());
            }

            //session
            session(config('admin.admin_user_key'), $user, config('admin.admin_user_scope'));
            $this -> success('login success', 'index/index');
        }else{
            $this->error("qing qiu  bu he fa");
        }
    }

    public function logout(){
        session(null, config('admin.admin_user_scope'));
        $this->redirect('login/index');
    }
}