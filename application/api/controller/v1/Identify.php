<?php

namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\Alidayu;
use app\common\lib\exception\ApiException;
use think\Controller;

class Identify extends Common
{
    public function save()
    {
        if (!request()->isPost()) {
            return show(0, '您提交的数据不合法', [], 403);
        }

        //检验数据
        $validate = validate('Identify');
        if (!$validate->check(input('post.'))) {
            return show(0, $validate->getError(), [], 403);
        }


        $id = input('param.id');
        if (Alidayu::getInstance()->setSmsIdentify($id)) {
            return show(1, "OK", [], 201);
        } else {
            return show(0, "error", [], 403);
        }
    }
}