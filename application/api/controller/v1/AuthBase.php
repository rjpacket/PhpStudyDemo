<?php

namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\Aes;
use app\common\lib\Alidayu;
use app\common\lib\exception\ApiException;
use app\common\lib\IAuth;
use app\common\model\User;
use think\Controller;

/**
 *
 * 需要登录的接口必须继承这个类
 * Class AuthBase
 * @package app\api\controller\v1
 */
class AuthBase extends Common
{
    //登录用户的基本信息
    public $user = [];

    public function _initialize()
    {
        parent::_initialize();
        if(!$this -> isLogin()){
            throw new ApiException('你没有登录', 403);
        }
    }

    /**
     * 判断是否登录
     * @return bool
     */
    public function isLogin(){
        $token = $this->headers['access_user_token'];
        if(empty($token)){
            return false;
        }

        $decrypt = Aes::decrypt($token);
        if(empty($decrypt)){
            return false;
        }
        if(!preg_match('/||/', $decrypt)){
            return false;
        }
        list($token, $id) = explode($decrypt, "||");
        $user = User::get(['token' => $token]);

        if(!$user || $user -> status != 1){
            return false;
        }

        if(time() > $user -> time_out){
            return false;
        }

        $this -> user = $user;

        return true;
    }
}