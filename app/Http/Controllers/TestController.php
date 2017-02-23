<?php


namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Sms\Request\V20160927 as Sms;

class TestController extends Controller
{
    public function __construct()
    {
    }

    public function test1()
    {
        include_once __DIR__ . '/../../Lib/ali/aliyun-php-sdk-core/Config.php';

        $iClientProfile = \DefaultProfile::getProfile("cn-hangzhou", 'LTAIb0zTl3G5u3St',
                                                      '6jXkQMKOHNATWeDXnejVA8NyD9moF6');
        $client = new \DefaultAcsClient($iClientProfile);
        $request = new Sms\SingleSendSmsRequest();
        $request->setSignName("验证测试");/*签名名称*/
        $request->setTemplateCode("SMS_48805094");/*模板code*/
        $request->setRecNum("18607131949");/*目标手机号*/
        $request->setParamString("{\"name\":\"sanyou\"}");/*模板变量，数字一定要转换为字符串*/
        try {
            $response = $client->getAcsResponse($request);
            print_r($response);
        }
        catch (\ClientException  $e) {
            print_r($e->getErrorCode());
            print_r($e->getErrorMessage());
        }
        catch (\ServerException $e) {
            print_r($e->getErrorCode());
            print_r($e->getErrorMessage());
        }
    }

    public function test2()
    {
        $header = [
            'headers' => [
                'X-LC-Id' => env('LC_APP_ID'),
                'X-LC-Key' => env('LC_APP_KEY'),
                'Content-Type' => 'application/json'
            ]
        ];
        $http = new Client($header);
        $param = [
            'json' => [
                'mobilePhoneNumber' => '18607131949',
                'op' => '验证'
            ],
            'verify' => false
        ];
        $response = $http->request('post', env('LC_REQUEST_URL'), $param);
        $code = $response->getStatusCode();
        if ($code == 200) {
            //            return ApiResponseService::success('', Code::SUCCESS, '获取短信验证码成功');
        }
    }

    public function test3()
    {
        $header = [
            'headers' => [
                'X-LC-Id' => env('LC_APP_ID'),
                'X-LC-Key' => env('LC_APP_KEY'),
                'Content-Type' => 'application/json'
            ]
        ];
        $http = new Client($header);
        $param = [
            'verify' => false
        ];
        $verifyUrl = env('LC_VERIFY_URL').'/318974?mobilePhoneNumber=18607131949';
        $response = $http->request('post', $verifyUrl, $param);
        $code = $response->getStatusCode();
        if ($code != 200) {
//            return ApiResponseService::showError(Code::SMSID_ERROR);
        }
    }
}