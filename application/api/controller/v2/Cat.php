<?php
namespace app\api\controller\v2;

use app\api\controller\Common;
use app\common\lib\exception\ApiException;
use think\Controller;

class Cat extends Common
{
    /**
     * 栏目接口
     * @return array
     */
    public function read()
    {
        $cats = config('cat.lists');

        $result[] = [

        ];
        foreach ($cats as $catid => $catname){
            $result[] = [
                'catid' => $catid,
                'catname' => $catname,
            ];
        }

        return show(1, "OK", $result, 200);
    }
}