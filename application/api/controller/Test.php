<?php
namespace app\api\controller;

use Aliyun\api_demo\SmsUtils;
use Aliyun\api_sdk\lib\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\api_sdk\lib\Core\DefaultAcsClient;
use Aliyun\api_sdk\lib\Core\Profile\DefaultProfile;
use app\common\lib\Alidayu;
use app\common\lib\exception\ApiException;
use think\Controller;
use Aliyun\api_demo\SmsDemo;

class Test extends Common
{
    public function index()
    {
        return [
            "abssas",
            "34534563",
            "5867tututu"
        ];
    }


    public function update($id = 0)
    {
        $id = input('put.id');
        return $id;
    }

    public function save(){
        $data = input('post.');
        if($data['mt'] != 1){
//            exception("您提交的数据不合法");
            throw new ApiException('您提交的数据不合法欧', 403);
        }
        return show(1, "ok", input('post.'), 200);
    }

    public function sendSms(){
        set_time_limit(0);
        header('Content-Type: text/plain; charset=utf-8');

        $response = Alidayu::getInstance() -> setSmsIdentify("13552280894");

        if($response) {
            return show(1, "ok", "send message success!!!", 200);
        }else{
            return show(0, "bad", "send message failure!!!", 200);
        }
    }
}