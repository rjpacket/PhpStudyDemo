<?php
namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\exception\ApiException;
use think\Controller;

class Index extends Common
{
    /**
     * 获取首页接口
     * @return array
     */
    public function index()
    {
       $heads = model('News') -> getIndexHeadNormalNews();

        $positions = model('News') -> getPositionNormalNews();

        $result = [
            "heads" => $this -> getDealNews($heads),
            "positions" => $this -> getDealNews($positions),
        ];

       return show(1, "ok", $result, 200);
    }

    /**
     * 客户端初始化接口
     */
    public function init(){
        $ver = model('Version') -> getLastNormalVersionByAppType($this->headers['app_type']);
//        halt($ver);
        if(empty($ver)){
            return new ApiException('error', 404);
        }

        if($ver->version  > $this -> headers['version']){
            $ver -> is_update = 1;
        }else{
            $ver -> is_update = 0;
        }

        return show(1, "OK", $ver, 200);
    }
}