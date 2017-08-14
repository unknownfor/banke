<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use OrgRepository;
use FreeStudyRepository;
use App\Models\Banke\BankeFreeStudy;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class FreeStudyController extends Controller
{
    /**
    * 免费学详情
    */
    public function v1_8($id)
    {
        $freestudy=BankeFreeStudy::find($id);
        return view('web.freestudy.v1_8')->with(compact(['freestudy']));
    }


    /**
     * 免费学详情
     */
    public function share_v1_8($id)
    {
        $freestudy=BankeFreeStudy::find($id);
        return view('web.freestudy.share_v1_8')->with(compact(['freestudy']));
    }

    /**获取短信验证码
     * @param int $type
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|mobile|unique:banke_user_profiles,mobile'
        ]);

        if ($validator->fails()) {
            return ApiResponseService::showError(Code::REGISTER_MOBILE_ERROR);
        }

        $userData = $request->all();
        $mobile = $userData['mobile'];
    }
}
