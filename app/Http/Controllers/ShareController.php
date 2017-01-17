<?php

namespace App\Http\Controllers;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use UserRepository;
use Illuminate\Http\Request;

class ShareController extends Controller
{

    /**
     * 分享机构详情
     */
    public function share_org($id){

        return view('web.org.share_org');
    }

    /**
     * 分享课程详情
     */
    public function share_course($org_id){

        return view('web.org.share_course');
    }

    /**
     * 分享邀请注册
     */
    public function invitation($welcome){

        return view('web.invite.invitation')->with(compact(['welcome']));
    }

    /**获取短信验证码
     * @param int $type
     */
    public function requestSmsCode(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|mobile|unique:users,mobile',
        ]);

        if ($validator->fails()) {
            return ApiResponseService::showError(Code::REGISTER_MOBILE_ERROR);
        }

        $userData = $request->all();
        $mobile = $userData['mobile'];
        try{
            $header = [
                'headers'=>[
                    'X-Bmob-Application-Id'=>env('BMOB_APP_ID'),
                    'X-Bmob-REST-API-Key'=>env('BMOB_REST_API_KEY'),
                    'Content-Type'=>'application/json'
                ]
            ];
            $http = new Client($header);
            $param = [
                'json'=>[
                    'mobilePhoneNumber'=>$mobile,
                    'template'=>'半课验证码'
                ]
            ];
            $response = $http->request('post', env('BMOB_REST_API_URL').'requestSmsCode', $param);
            $code = $response->getStatusCode();
            if($code == 200){
                return ApiResponseService::success('', Code::SUCCESS, '获取短信验证码成功');
            }
        }catch (ClientException $e){
            return ApiResponseService::showError(Code::VERIFY_SMSID_ERROR);
        }
    }

    /**
     * 注册用户
     * @author shaolei
     * @date   2016-04-14T11:31:29+0800
     * @param  Request        $request [description]
     * @return [type]                            [description]
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|mobile|unique:users,mobile',
            'smsId' => 'required',
            'welcome'   => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseService::showError(Code::REGISTER_MOBILE_ERROR);
        }
        $userData = $request->all();
        $mobile = $userData['mobile'];
        $smsId = $userData['smsId'];
        try{
            $header = [
                'headers'=>[
                    'X-Bmob-Application-Id'=>env('BMOB_APP_ID'),
                    'X-Bmob-REST-API-Key'=>env('BMOB_REST_API_KEY'),
                    'Content-Type'=>'application/json'
                ]
            ];
            $http = new Client($header);
            $param = [
                'json'=>[
                    'mobilePhoneNumber'=>$mobile
                ]
            ];
            $response = $http->request('post', env('BMOB_REST_API_URL').'verifySmsCode/'.$smsId, $param);
            $code = $response->getStatusCode();
            if($code != 200){
                return ApiResponseService::showError(Code::SMSID_ERROR);
            }
        }catch (ClientException $e){
            return ApiResponseService::showError(Code::VERIFY_SMSID_ERROR);
        }
        $password = randCode(6, 'NUMBER');
        $request['password'] = $password;
        $result = UserRepository::register($request);
        if($result){
            try{
                $header = [
                    'headers'=>[
                        'X-Bmob-Application-Id'=>env('BMOB_APP_ID'),
                        'X-Bmob-REST-API-Key'=>env('BMOB_REST_API_KEY'),
                        'Content-Type'=>'application/json'
                    ]
                ];
                $http = new Client($header);
                $param = [
                    'json'=>[
                        'mobilePhoneNumber'=>$userData['mobile'],
                        'content'=>'您好！20元现金红包已成功发送至您的半课APP账户中！登陆账号为您的领取手机号码，'
                            .'初始密码为'.$password.'，记得登陆后修改密码！【半课】'
                    ]
                ];
                $response = $http->request('post', env('BMOB_REST_API_URL').'requestSms', $param);
                Log::info('$response=================='.json_encode($response));
                $code = $response->getStatusCode();
                Log::info('$code=================='.$code);
                /*if($code != 200){
                    return ApiResponseService::showError(Code::SMSID_ERROR);
                }*/
            }catch (ClientException $e){
                var_dump($e);
                return ApiResponseService::showError(Code::SEND_SMS_ERROR);
            }
            return ApiResponseService::success('', Code::SUCCESS, '注册成功');
        }else{
            return ApiResponseService::showError(Code::REGISTER_ERROR);
        }
    }
}
