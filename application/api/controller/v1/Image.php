<?php

namespace app\api\controller\v1;

use app\common\lib\Upload;

class Image extends AuthBase
{
    public function save(){
        $image = Upload::image();
        if($image){
            return show(1, "OK", config('qiniu.image_url').'/'.$image, 200);
        }
    }
}