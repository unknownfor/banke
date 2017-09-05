<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Lib\Code;
use OrgRepository;
use FreeStudyRepository;
use FreeStudyUsersRepository;
use App\Models\Banke\BankeFreeStudy;
use App\Models\Banke\BankeFreeStudyUsers;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;

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

    /**
     * 免费学详情
     */
    public function share_v1_9($id,$uid)
    {
        $freestudy=BankeFreeStudy::find($id);
        return view('web.freestudy.share_v1_8')->with(compact(['freestudy','uid']));
    }

    /*
     * 申请
     * @param int $type
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|mobile',
            'free_study_id'=>'required|numeric'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $sss='';
            foreach ($errors->all() as $message) {
                $sss.=$message;
            }
            return response()->json(['msg' => $sss, 'status' => false]);
        }

        $id=$request['free_study_id'];
        $freestudy=BankeFreeStudy::find($id);
        if($freestudy['status']==2){
            return response()->json(['msg' => '该活动已结束，不能申请', 'status' => false,'code'=>2]);
        }
        $users=BankeFreeStudyUsers::where(['free_study_id'=>$id,'mobile'=>$request['mobile']]);
        if($users->count()>0){
            return response()->json(['msg' => '您已申请该活动，不能再申请', 'status' => false,'code'=>-1]);
        }

        $userData = $request->all();
        $result = FreeStudyUsersRepository::store($request);
        if ($result) {
            return ApiResponseService::success('', Code::SUCCESS, '申请成功');
        }
        return ApiResponseService::showError(Code::REGISTER_ERROR);
    }
}
