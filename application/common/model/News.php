<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/4
 * Time: 21:58
 */

namespace app\common\model;

class News extends Base
{
    public function getNews($data = []){
        $data['status'] = [
          'neq', config('code.status_delete')
        ];

        $order = ['id' => 'desc'];

        $result = $this -> where($data)
            -> order($order)
            -> paginate();
//        echo $this -> getLastSql();
        return $result;
    }

    public function getNewsByCondition($condition = [], $from = 0, $size = 5){
        if(!isset($condition['status'])) {
            $condition['status'] = [
                'neq', config('Code.status_delete')
            ];
        }

        $order = ['id' => 'desc'];

        $result = $this -> where($condition)
            -> limit($from, $size)
            -> order($order)
            -> select();

//        echo $this -> getLastSql();

        return $result;
    }

    /**
     *
     * 获取条数
     * @param array $param
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getNewsCountByCondition($condition = []){
        if(!isset($condition['status'])) {
            $condition['status'] = [
                'neq', config('code.status_delete')
            ];
        }

        $count = $this -> where($condition)
            -> count();

        return $count;
    }

    /**
     * 获取首页头图
     * @param int $num
     */
    public function getIndexHeadNormalNews($num = 4){
        $data = [
            'status' => 1,
            'is_head_figure' => 1
        ];

        $order = [
            'id' => 'desc'
        ];

        return $this -> where($data)
            -> field(['id', 'catid', 'image', 'title'])
            -> order($order)
            -> limit($num)
            -> select();
    }

    public function getPositionNormalNews($num = 20){
        $data = [
            'status' => 1,
            'is_position' => 0
        ];

        $order = [
            'id' => 'desc'
        ];

        return $this -> where($data)
            -> field(['id', 'catid', 'image', 'title'])
            -> order($order)
            -> limit($num)
            -> select();
    }
}