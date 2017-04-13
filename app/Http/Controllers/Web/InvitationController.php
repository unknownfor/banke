<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeOrg;
use App\Repositories\admin\OrgRepository;
use App\Repositories\admin\OrgApplyForRepository;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    /**
     * 分享邀请注册
     */
    public function invitation($welcome)
    {
        return view('web.invite.invitation-v1_2')->with(compact(['welcome']));
    }

    /**
     * 注册用户
     * @author shaolei
     * @date   2016-04-14T11:31:29+0800
     * @param  Request $request [description]
     * @return [type]                            [description]
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|mobile|unique:banke_user_profiles,mobile',
            'password'=>'required|min:6|max:32',
            'smsId' => 'required',
            'welcome' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseService::showError(Code::REGISTER_MOBILE_ERROR);
        }
        $userData = $request->all();
        $mobile = $userData['mobile'];
        $smsId = $userData['smsId'];
        try {
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
            $verifyUrl = env('LC_VERIFY_URL').'/'.$smsId.'?mobilePhoneNumber='.$mobile;
            $response = $http->request('post', $verifyUrl, $param);
            $code = $response->getStatusCode();
            if ($code != 200) {
                return ApiResponseService::showError(Code::SMSID_ERROR);
            }
        }
        catch (ClientException $e) {
            return ApiResponseService::showError(Code::VERIFY_SMSID_ERROR);
        }
        $result = UserRepository::register($request);
        if ($result) {
            try {
                $config = BankeDict::find(1);
                $pa = [
                    'json' => [
                        'mobilePhoneNumber' => $mobile,
                        'template' =>'invi_psw',
                        'money' => $config['value'],
//                        'psw' => $password
                    ],
                    'verify' => false
                ];
                $headers = [
                    'headers' => [
                        'X-LC-Id' => env('LC_APP_ID'),
                        'X-LC-Key' => env('LC_APP_KEY'),
                        'Content-Type' => 'application/json'
                    ]
                ];

                $http = new Client($headers);
                $res = $http->request('post', env('LC_REQUEST_URL'), $pa);

                if ($res) {
                    return ApiResponseService::success('', Code::SUCCESS, '注册成功');
                }
                else {
                    return ApiResponseService::showError(Code::SEND_SMS_ERROR);
                }
            }
            catch (ClientException $e) {
                return ApiResponseService::showError(Code::SEND_SMS_ERROR);
            }
        }
        else {
            return ApiResponseService::showError(Code::REGISTER_ERROR);
        }
    }

}
