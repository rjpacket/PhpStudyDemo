<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


/**
 *
 * 导航
 * @param $obj
 * @return string
 */
function pagination($obj)
{
    if (!$obj) {
        return '';
    }

    $params = request()->param();

    return '<div class="imooc-app">' . $obj->appends($params)->render() . '</div>';
}

/**
 *
 * 获取分类名字
 * @param $catId
 * @return string
 */
function getCatName($catId)
{
    if (!$catId) {
        return '';
    }

    $config = config('Cat.lists');

    return !empty($config[$catId]) ? $config[$catId] : '';
}

function isYesNo($str){
    return $str ? '是': '否';
}

/**
 *
 * 通用的json返回
 * @param $status
 * @param $message
 * @param array $data
 * @param int $httpcode
 * @return \think\response\Json
 */
function show($status, $message, $data = [], $httpcode = 200){
    $result = [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];
    return json($result, $httpcode);
}