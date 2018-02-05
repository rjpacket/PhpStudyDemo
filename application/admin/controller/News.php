<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 22:31
 */

namespace app\admin\controller;


class News extends Base
{
    public function index(){

        //模式一
//        $news = model('News') -> getNews();
//        halt($news);

        //模式二
        //page  size  from
        $wheredata = [];
        $data = input('param.');
        $wheredata['page'] = !empty($data['page']) ? $data['page'] : 1;
        $wheredata['size'] = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');

        $news = model('News') -> getNewsByCondition($wheredata);

        $total = model('News') -> getNewsCountByCondition($wheredata);

        $pageTotal = ceil($total / $wheredata['size']);
        return $this -> fetch('', [
            'news' => $news,
            'pageTotal' => $pageTotal,
            'curr' => $wheredata['page']
        ]);
    }

    public function add()
    {
        if(request() -> isPost()){
            $input = input('post.');
//            halt($input);

            //数据校验
            $validate = validate('News');
            if(!$validate -> check($input)){
                return $this -> result('', 0, $validate -> getError());
            }

            try {
                $id = model('News')->add($input);
            } catch (\Exception $e) {
                return $this -> result('', 0, '新增失败');
            }

            if($id){
                return $this -> result(['jump_url' => url('news/index')], 1, 'OK');
            }else{
                return $this -> result('', 0, '新增失败');
            }
        }else {
            return $this->fetch('', [
                'cats' => config('Cat.lists')
            ]);
        }
    }
}