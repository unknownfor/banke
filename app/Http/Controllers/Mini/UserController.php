<?php

namespace App\Http\Controllers\Mini;

use App\Http\Controllers\Controller;
use App\Repositories\admin;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use SuperClosure\Analyzer\Token;
use Validator;
use Illuminate\Http\Request;
use UserRepository;
use App\Services\Mini\TokenService;

class UserController extends Controller
{

    /**获得Token**/
    public function getToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|mobile',
            'password'=>'required|min:6|max:32',
            'code'=>'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $sss='';
            foreach ($errors->all() as $message) {
                $sss.=$message;
            }
            return response()->json(['msg' => $sss, 'status' => false]);
        }
        try {
            $tokenService = new TokenService();
            $token = $tokenService->getToken($request->all()['code']);
            $orgId = UserRepository::loginByMobileAndPwdOrg($request->all());
            if ($orgId!=0) {
                $result=['token'=>$token,'orgId'=>$orgId];
                return ApiResponseService::success($result, Code::SUCCESS, '登录成功');
            } else {
                return ApiResponseService::showError(Code::LOGIN_ERROR);
            }
        }
        catch (ClientException $e) {
                return ApiResponseService::showError(Code::VERIFY_SMSID_ERROR);
            }
    }

    /*通过code获取用户的appid,并记录到数据库中*/
    public function saveUserInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $sss='';
            foreach ($errors->all() as $message) {
                $sss.=$message;
            }
            return response()->json(['msg' => $sss, 'status' => false]);
        }
        try {

        }
        catch (ClientException $e) {
            return ApiResponseService::showError(Code::VERIFY_SMSID_ERROR);
        }
    }
}
