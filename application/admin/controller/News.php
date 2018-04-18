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
    public function index()
    {

        //模式一
//        $news = model('News') -> getNews();
//        halt($news);

        //模式二
        //page  size  from
        $wheredata = [];
        $data = input('param.');

        $query = http_build_query($data);
//        halt($data);

        if(!empty($data['start_time']) && !empty($data['end_time']) && $data['end_time'] > $data['start_time']){
            $wheredata['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])]
            ];
        }

        if(!empty($data['catid'])){
            $wheredata['catid'] = intval($data['catid']);
        }

        if(!empty($data['title'])){
            $wheredata['title'] = ['like', '%'.$data['title'].'%'];
        }

        $this->getPageAndSize($data);
//        $wheredata['page'] = $this->page;
//        $wheredata['size'] = $this->size;

        $news = model('News')->getNewsByCondition($wheredata, $this->from, $this->size);

        $total = model('News')->getNewsCountByCondition($wheredata);

        $pageTotal = ceil($total / $this->size);

        return $this->fetch('', [
            'cats' => config('Cat.lists'),
            'news' => $news,
            'pageTotal' => $pageTotal,
            'curr' => $this->page,
            'start_time' => empty($data['start_time'])?'':$data['start_time'],
            'end_time' => empty($data['end_time'])?'':$data['end_time'],
            'catid' => empty($data['catid'])?'':$data['catid'],
            'title' => empty($data['title'])?'':$data['title'],
            'query' => $query
        ]);
    }

    public function add()
    {
        if (request()->isPost()) {
            $input = input('post.');
//            halt($input);

            //数据校验
            $validate = validate('News');
            if (!$validate->check($input)) {
                return $this->result('', 0, $validate->getError());
            }

            try {
                $id = model('News')->add($input);
            } catch (\Exception $e) {
                return $this->result('', 0, '新增失败');
            }

            if ($id) {
                return $this->result(['jump_url' => url('news/index')], 1, 'OK');
            } else {
                return $this->result('', 0, '新增失败');
            }
        } else {
            return $this->fetch('', [
                'cats' => config('Cat.lists')
            ]);
        }
    }
}