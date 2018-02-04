<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 22:43
 */

namespace app\common\lib;

//引入鉴权类
use Qiniu\Auth;
//引入上传类
use Qiniu\Storage\UploadManager;

class Upload
{

    /**
     * 图片上传
     */
    public static function image()
    {
        $file = $_FILES['file']['tmp_name'];
        if (empty($file)) {
            exception('您提交的图片不合法', 404);
        }

        $config = config('qiniu');

        $auth = new Auth($config['ak'], $config['sk']);

        //生成token
        $token = $auth->uploadToken($config['bucket']);

        $ext = explode('.', $_FILES['file']['name']);
        $ext = $ext[1];
//        $pathinfo = pathinfo($_FILES['file']['name']);
//        $ext = $pathinfo['extension'];

        $key = date('Y') . '/' . date('m') . '/' . substr(md5($file), 0, 5)
            . date('YmdHis') . rand(0, 9999) . '.' . $ext;

        $uploadManager = new UploadManager();

        list($response, $error) = $uploadManager->putFile($token, $key, $file);

        if ($error !== null) {
            return null;
        } else {
            return $key;
        }
    }
}

