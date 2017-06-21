<?php

namespace App\Http\Controllers\Mini;

use App\Http\Controllers\Controller;
use App\Repositories\admin;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;
use UserRepository;

class UserController extends Controller
{

    /**获得Token**/
    public function getToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|mobile',
            'password'=>'required|min:6|max:32',
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
            $token=csrf_token();
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
}
