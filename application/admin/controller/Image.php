<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 22:58
 */

namespace app\admin\controller;


use app\common\lib\Upload;
use think\Request;

class Image extends Base
{
//    public function upload()
//    {
//
//        $file = Request::instance()->file('file');
////        halt($file);
//        //把图片上传到指定文件夹
//        $info = $file->move('upload');
//        if ($info && $info->getPathname()) {
//            $data = [
//                'status' => 1,
//                'message' => 'OK',
//                'data' => '/' . $info->getPathname()
//            ];
//            echo json_encode($data);
//            exit;
//        }
//
//        $data = [
//            'status' => 0,
//            'message' => 'error'
//        ];
//        echo json_encode($data);
//        exit;
//    }

    public function upload()
    {
        try {
            $image = Upload::image();
//            halt($image);
        } catch (\Exception $e) {
            $data = [
                'status' => 0,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            exit;
        }

        if ($image) {
            $data = [
                'status' => 1,
                'message' => 'OK',
                'data' => config('qiniu.image_url') . '/' . $image
            ];
            echo json_encode($data);
            exit;
        } else {
            $data = [
                'status' => 0,
                'message' => 'error'
            ];
            echo json_encode($data);
            exit;
        }
    }
}