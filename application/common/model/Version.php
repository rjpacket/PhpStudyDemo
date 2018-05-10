<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/4
 * Time: 21:58
 */

namespace app\common\model;

class Version extends Base
{
    /**
     * 获取最后一条更新数据
     * @param string $appType
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getLastNormalVersionByAppType($appType = ''){
        $data = [
            'status' => 1,
            'app_type' => $appType
        ];

        $order = [
            'id' => 'desc'
        ];

        return $this->where($data)
            ->order($order)
            ->limit(1)
            ->find();
    }
}