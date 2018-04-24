<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/19
 * Time: 22:50
 */

namespace app\api\controller;

use app\common\lib\Aes;
use app\common\lib\exception\ApiException;
use app\common\lib\IAuth;
use app\common\lib\Time;
use think\Cache;
use think\Controller;

class Common extends Controller
{

    private $headers = '';

    //控制器的page size
    public $page = 1;
    public $size = 10;
    public $from = 0;

    public function _initialize()
    {
        $this->checkRequestAuth();
    }

    /**
     * 检查每次app请求的数据是否合法
     */
    public function checkRequestAuth()
    {
        //首先需要获取Header
        $header = request()->header();
//        halt($header);

        //sign  加密需要客户端工程师去做  解密 服务端工程师
//        $this -> aesTest();
        if (empty($header['sign'])) {
            throw new ApiException("sign is empty", 400);
        }

        if (!in_array($header['app_type'], config('app.app_types'))) {
            throw new ApiException("app_type is error", 400);
        }

        if (!config('app_debug')) {
            //校验sign
            if (!IAuth::checkSignPass($header)) {
                throw new ApiException("sign is error", 401);
            }

            Cache::set($header['sign'], 1, config('app.app_sign_cache_time'));
        }

        $this->headers = $header;
    }

    /**
     * 测试 sign
     */
    public function aesTest()
    {
        $str = "id=1&name=rjp";
        $aesStr = "PDU8CE4P928nuLB5Erq0Rg==";

//        echo Aes::encrypt($str);exit;
//        echo Aes::decrypt($aesStr);exit;

        $data = [
            'did' => '23',
            'name' => 'rjp',
            'time' => Time::get13TimeStamp()
        ];

        echo IAuth::setSign($data);
        exit;

        $str = "9q5xwB0fO8K/DWC9PXaTNg==";
        echo Aes::decrypt($str);
        exit;
    }

    /**
     * 将catid变为 名字
     * @param array $news
     * @return array
     */
    public function getDealNews($news = [])
    {
        if (empty($news)) {
            return [];
        }
        $cats = config('Cat.lists');

        foreach ($news as $key => $value) {
            $news[$key]['catname'] = $cats[$value['catid']] ? $cats[$value['catid']] : "-";
        }

        return $news;
    }

    /**
     * 处理page size
     * @param $data
     */
    public function getPageAndSize($data)
    {
        $this->page = !empty($data['page']) ? $data['page'] : 1;
        $this->size = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');
        $this->from = ($this->page - 1) * $this->size;
    }
}