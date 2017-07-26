<?php

namespace App\Services;

use Cache;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class UserService
{
    //根据微信信息，得到openid
    private function getWxInfo($code){
        $http = new Client();
        $verifyUrl = config('mini.global.wxpay.get_openid_url').
            'appid='. config('mini.global.wxpay.appid').
            '&secret='. config('mini.global.wxpay.appsecret').
            '&js_code='.$code.
            '&grant_type=authorization_code';
        $response = $http->request('get', $verifyUrl);
        $code = $response->getStatusCode();
        if ($code != 200) {
            return ApiResponseService::showError(Code::SMSID_ERROR);
        }
    }
}