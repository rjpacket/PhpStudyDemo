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
}