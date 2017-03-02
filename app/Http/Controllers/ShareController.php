<?php

namespace App\Http\Controllers;

use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeDict;
use App\Models\Banke\BankeNews;
use App\Models\Banke\BankeOrg;
use App\Repositories\admin\OrgRepository;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use UserRepository;
use App\Repositories\admin\ReportRepository;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    /**
     * 规则详情
     */
    public function rule()
    {
        return view('web.rule.rule');
    }

    /**
     * 规则详情
     */
    public function share_rule()
    {
        return view('web.rule.share_rule');
    }

    /**
     * 动态详情
     */
    public function news($id)
    {
        $news = BankeNews::find($id);
        return view('web.news.news')->with(compact(['news']));
    }

    /**
     * 机构详情
     */
    public function org($id)
    {
        $org = BankeOrg::find($id);
        return view('web.org.org')->with(compact(['org']));
    }

    /**
     * 课程详情
     */
    public function course($id)
    {
        $course = $this->getCourseInfo($id);
        return view('web.org.course')->with(compact(['course']));
    }

    /**
     * 分享课程详情
     */
    public function share_course($id)
    {
        $course = $this->getCourseInfo($id);
        return view('web.org.share_course')->with(compact(['course']));
    }

    /**
     * 分享机构详情
     */
    public function share_org($id)
    {
        $org = BankeOrg::find($id);
        return view('web.org.share_org')->with(compact(['org']));
    }



    public function  getCourseInfo($id){
        $course = BankeCourse::find($id);

        $percent = new BankeDict;
        $percent = $percent->whereIn('id', [3, 4])->get();

        if($course['checkin_award']=='' || $course['checkin_award']==0){
            $course['checkin_award']=$percent[0]['value'];
        }
        if($course['task_award']=='' || $course['task_award']==0){
            $course['task_award']=$percent[1]['value'];
        }
        $course['discount'] = $course['checkin_award'] + $course['task_award'];
        $course['real_price'] = moneyFormat($course['price'] * $course['discount'] / 100);
        $org = BankeOrg::find($course['org_id']);
        $course['org'] = $org;
        return $course;
    }

    /**
     * 分享邀请注册
     */
    public function invitation($welcome)
    {

        return view('web.invite.invitation')->with(compact(['welcome']));
    }

    /**获取短信验证码
     * @param int $type
     */
    public function requestSmsCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //            'mobile' => 'required|mobile|unique:users,mobile',
            'mobile' => 'required|mobile|unique:banke_user_profiles,mobile'
        ]);

        if ($validator->fails()) {
            return ApiResponseService::showError(Code::REGISTER_MOBILE_ERROR);
        }

        $userData = $request->all();
        $mobile = $userData['mobile'];
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
                'json' => [
                    'mobilePhoneNumber' => $mobile,
                    'op' => '验证'
                ],
                'verify' => false
            ];
            $response = $http->request('post', env('LC_REQUEST_URL'), $param);
            $code = $response->getStatusCode();
            if ($code == 200) {
                return ApiResponseService::success('', Code::SUCCESS, '获取短信验证码成功');
            }
        }
        catch (ClientException $e) {
            return ApiResponseService::showError(Code::VERIFY_SMSID_ERROR);
        }
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
        $password = randCode(6, 'NUMBER');
        $request['password'] = $password;
        $result = UserRepository::register($request);
        if ($result) {
            try {
                $config = BankeDict::find(1);
                $pa = [
                    'json' => [
                        'mobilePhoneNumber' => $mobile,
                        'template' =>'invi_psw',
                        'money' => $config['value'],
                        'psw' => $password
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


    /**
     * 隐私政策
     */
    public function privacy()
    {
        return view('web.privacy.privacy');
    }

    public function download()
    {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $is_weixin = strpos($agent, 'micromessenger') ? true : false;
        if ($is_weixin) {
//            return view("web.download.downloadPrompt");
            header("Location: http://a.app.qq.com/o/simple.jsp?pkgname=com.banke");
            exit;
        }
        else {
            header("Content-type:text/html; charset=utf-8");
            if (stristr($_SERVER['HTTP_USER_AGENT'], 'Android')) {
                $is_qq = strpos($agent, 'mobile mqqbrowser') ? true : false;
                if ($is_qq) {
//                    return view("web.download.downloadPrompt");
                    header("Location: http://a.app.qq.com/o/simple.jsp?pkgname=com.banke");
                }
                else {
                    header('Location: ' . env('APP_DOWNLOAD'));
                    exit;
                }
            }
            else if (stristr($_SERVER['HTTP_USER_AGENT'], 'iPhone')) {
                header('Location: https://itunes.apple.com/cn/app/ban-ke/id1188151603?mt=8');
                exit;
            }
            else {
                header('Location: ' . env('APP_DOWNLOAD'));
                exit;
            }
        }
    }

    /**获得媒体报道**/
    public function getMediaReport()
    {
        try {
            $repository = new ReportRepository;
            $report = $repository->getTop5();
            $param = [
                'data' => $report,
                'template' => '媒体报道',
                'status' => true
            ];
            return ApiResponseService::success('', Code::SUCCESS, $param);
        }
        catch (ClientException $e) {
            $param = [
                'template' => '媒体报道失败',
                'status' => false
            ];
            return ApiResponseService::showError(Code::VERIFY_SMSID_ERROR, $param);
        }
    }

    /**获得入驻机构**/
    public function getChoicenessOrgs()
    {
        try {
            $repository = new OrgRepository();
            $org = $repository->getTop(10);
            $param = [
                'data' => $org,
                'template' => '获取精选机构成功',
                'status' => true
            ];
            return ApiResponseService::success('', Code::SUCCESS, $param);
        }
        catch (ClientException $e) {
            $param = [
                'template' => '获取媒体报道失败',
                'status' => false
            ];
            return ApiResponseService::showError(Code::VERIFY_SMSID_ERROR, $param);
        }
    }

}
