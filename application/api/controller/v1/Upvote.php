<?php

namespace app\api\controller\v1;

use think\Exception;

class Upvote extends AuthBase
{
    public function save(){

        $id = input('post.id', 0, 'intval');
        if(empty($id)){
            return show(0, "id 不存在", [], 404);
        }
        //查询文章是否存在

        //查询库里是否存在点赞
        $data = [
            'user_id' => $this -> user -> id,
            'news_id' => $id
        ];
        $userNews = model('UserNews')->get($data);
        if($userNews){
            return show(0, "已经点赞过了", [], 404);
        }

        try {
            $userNewsId = model('UserNews')->add($data);
            if($userNewsId){
                model('News') -> where(['id' => $id]) -> setInc('upvote_count');
                return show(1, "ok", [], 200);
            }else{
                return show(0, '点赞失败', [], 500);
            }
        } catch (\Exception $e) {
            return show(0, "服务器错误", [], 500);
        }
    }
}