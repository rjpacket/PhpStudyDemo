<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/4
 * Time: 21:57
 */

namespace app\common\model;
use think\Model;

class Base extends Model
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