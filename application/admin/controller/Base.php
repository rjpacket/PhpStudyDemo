<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 16:03
 */

namespace app\admin\controller;


use think\Controller;

/**
 *
 * 后台基础类库
 * Class Base
 * @package app\admin\controller
 */
class Base extends Controller
{
    public $page = '';
    public $size = '';
    //起始值
    public $from = '';

    /**
     * 初始化
     */
    public function _initialize()
    {
        //判断用户是否登陆
        $isLogin = $this->isLogin();
        if (!$isLogin) {
            return $this->redirect('login/index');
        }
    }

    public function isLogin()
    {
        $user = session(config('admin.admin_user_key'), '', config('admin.admin_user_scope'));
        if ($user && $user->id) {
            return true;
        }
        return false;
    }

    public function getPageAndSize($data)
    {
        $this->page = !empty($data['page']) ? $data['page'] : 1;
        $this->size = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');
        $this->from = ($this->page - 1) * $this->size;
    }

    /**
     * 删除逻辑
     */
    public function delete($id = 0){
        if(!intval($id)){
            return $this->result("", 0, "ID不合法");
        }

        $res = model('News') -> save(['status' => -1], ['id' => $id]);

    }
}