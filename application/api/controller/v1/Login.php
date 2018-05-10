<?php

namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\Aes;
use app\common\lib\Alidayu;
use app\common\lib\exception\ApiException;
use app\common\lib\IAuth;
use app\common\model\User;
use think\Controller;

class Login extends Common
{
    public function save()
    {
        if (!request()->isPost()) {
            return show(0, 'error', [], 403);
        }

        $param = input('param.');
        if (empty($param['phone'])) {
            return show(0, '没有手机号', [], 404);
        }
        if (empty($param['code'])) {
            return show(0, '没有验证码', [], 404);
        }

        if(!empty($param['code'])) {
            $code = Alidayu::getInstance()->checkSmsIdentify($param['phone']);
            if ($code != $param['code']) {
                return show(0, "error code", [], 403);
            }
        }

        //第一次登录 注册
        $token = IAuth::setAppLoginToken($param['phone']);
        $data = [
            'token' => $token,
            'time_out' => strtotime("+".config('app.login_time_out_day')."days"),
        ];

        //查询号码是否存在
        $user = User::get(['phone' => $param['phone']]);
        if($user && $user -> status == 1){
            if(!empty($param['password'])){
                if(IAuth::setPassword($param['password']) != $user -> password){
                    return show(0, "密码不正确", [], 403);
                }
            }
            $id = model('User') -> save($data, ['phone' => $param['phone']]);
        }else {
            if(!empty($param['code'])) {
                $data['name'] = 'rjp' . $param['phone'];
                $data['status'] = 1;
                $data['phone'] = $param['phone'];

                $id = model('User')->add($data);
            }else{
                return show(0, "用户不存在", [], 403);
            }
        }

        if($id){
            $result = [
                'token' => Aes::encrypt($token."||".$id)
            ];
            return show(1, "注册成功", $result, 200);
        }else{
            return show(0, "登录失败", [], 403);
        }
    }
}