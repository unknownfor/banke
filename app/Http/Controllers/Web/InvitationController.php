<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeCashBackUser;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeDict;
use App\Models\Banke\BankeGroupbuying;
use App\Repositories\admin\GroupbuyingWordsRepository;
use App\Repositories\admin;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;
use UserRepository;
use CourseRepository;
use EnrolRepository;
use GroupbuyingRepository;
use OrderRepository;

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
        $result = UserRepository::register($userData);
        if ($result) {
            return ApiResponseService::success('', Code::SUCCESS, '注册成功');
        }
        else {
            return ApiResponseService::showError(Code::REGISTER_ERROR);
        }
    }

    public function doEnrol_v1_3(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|mobile',
            'org_id'=>'required',
            'course_id' => 'required',
            'invitation_uid' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $sss='';
            foreach ($errors->all() as $message) {
                $sss.=$message;
            }
            return response()->json(['msg' => $sss, 'status' => false]);
        }

        $result = EnrolRepository::store($request);
        if ($result) {
            return ApiResponseService::success('', Code::SUCCESS, '预约成功');
        }
        return ApiResponseService::showError(Code::REGISTER_ERROR);
    }

    public function doEnrol_v1_6(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|mobile',
            'comment'=>'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $sss='';
            foreach ($errors->all() as $message) {
                $sss.=$message;
            }
            return response()->json(['msg' => $sss, 'status' => false]);
        }

        $result = EnrolRepository::store($request);
        if ($result) {
            return ApiResponseService::success('', Code::SUCCESS, '预约成功');
        }
        return ApiResponseService::showError(Code::REGISTER_ERROR);
    }

    /**
     * 分享预约
     */
    public function enrol_v1_3($uid,$cid)
    {
        $user=UserRepository::getUserSimpleInfoById($uid);
        $course=CourseRepository::show($cid);

        $baseUrl='http://'.env('ADMIN_DOMAIN');
        $course['link_url']=$baseUrl.'/v1.2/share/course/'.$cid;
        $ruleLinkUrl=$baseUrl.'/v1.2/share/rule';
        $org=$course->org;
        return view('web.invite.enrol-v1_3')->with(compact(['user','course','org','ruleLinkUrl']));
    }

    /**
     * 分享预约
     */
    public function enrol_v1_5($uid,$cid,$typeId=1,$recordId)
    {
        $user=UserRepository::getUserSimpleInfoById($uid);
        $course=CourseRepository::show($cid);
        if(!$course){
            abort(404);
        }

        $baseUrl='http://'.env('ADMIN_DOMAIN');
        $course['link_url']=$baseUrl.'/v1.5/share/course/'.$cid;

        $maxAwardPercent=$course['task_award']+$course['checkin_award'];

        $course['max_award'] = moneyFormatFloor($course['price']*$maxAwardPercent/100);
        $course['max_award_percent'] = $maxAwardPercent;
        $course['price'] = moneyFormatFloor($course['price']);

        $ruleLinkUrl=$baseUrl.'/v1.5/share/rule';  //返现规则
        $org=$course->org;

        //随机图
        $word=GroupbuyingWordsRepository::getRandomRecord();

        //参团人员
        $groupbuyingId=GroupbuyingRepository::getGroupbuyingByCidAndUid($uid,$cid);
        $members=GroupbuyingRepository::getAllMembersByGroupbuyingId($groupbuyingId,2);


        $organizer_award=moneyFormatFloor($course['price']*$course['z_award_amount']/100);

        $award=Array('organizer_award'=>$organizer_award,'member_award'=>moneyFormatFloor($course['max_award']));

        $shareInfo=Array('type_id'=>$typeId,'record_id'=>$recordId);

        return view('web.invite.enrol-v1_5')->with(compact([
            'user',
            'course',
            'org',
            'ruleLinkUrl',
            'word',
            'shareInfo',
            'members',
            'award'
            ]));
    }

}
