<?php
namespace app\api\controller\v1;

use app\api\controller\Common;
use app\common\lib\exception\ApiException;
use think\Controller;

class News extends Common
{
    /**
     * 获取新闻列表接口
     * @return array
     */
    public function index()
    {
       //校验
        $data = input('get.');

        $wheredata['status'] = config('code.status_normal');
        if(!empty($data['catid'])) {
            $wheredata['catid'] = input('get.catid', 0, 'intval');
        }

        if(!empty($data['title'])){
            $wheredata['title'] = ['like', '%'.$data['title'].'%'];
        }

        $total = model('News') -> getNewsCountByCondition($wheredata);

        $this -> getPageAndSize($data);
        $news = model('News') -> getNewsByCondition($wheredata, $this -> from, $this -> size);

        $result = [
            'total' => $total,
            'page_num' => ceil($total / $this -> size),
            'list' => $this -> getDealNews($news)
        ];
        return show(1, "OK", $result, 200);
    }
}