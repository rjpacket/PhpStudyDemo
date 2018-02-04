<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/7
 * Time: 20:43
 */

namespace app\common\model;


use think\Model;

class AdminUser extends Model
{
    //自动插入时间
    protected $autoWriteTimestamp = true;

    public function add($data){
        if(!is_array($data)){
            exception("数据不合法");
        }

        $this -> allowField(true) -> save($data);

        return $this -> id;
    }
}