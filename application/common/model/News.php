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

    public function getNewsByCondition($param = []){
        $condition['status'] = [
            'neq', config('code.status_delete')
        ];

        $order = ['id' => 'desc'];

        $from = ($param['page'] - 1) * $param['size'];

        $result = $this -> where($condition)
            -> limit($from, $param['size'])
            -> order($order)
            -> select();

        return $result;
    }

    /**
     *
     * 获取条数
     * @param array $param
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getNewsCountByCondition($param = []){
        $condition['status'] = [
            'neq', config('code.status_delete')
        ];

        $count = $this -> where($condition)
            -> count();

        return $count;
    }
}