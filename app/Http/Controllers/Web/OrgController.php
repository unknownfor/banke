<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeCourse;
use App\Repositories\admin\OrgRepository;
use App\Repositories\admin\OrgApplyForRepository;
use App\Repositories\admin\OrgSummaryRepository;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class OrgController extends Controller
{
    /**
     * 机构详情
     */
    public function org_v1_2($id)
    {
        $org = BankeOrg::find($id);
        return view('web.org.org-v1_2')->with(compact(['org']));
    }


    /**
     * 分享机构详情
     */
    public function share_org_v1_2($id)
    {
        $org = BankeOrg::find($id);
        return view('web.org.share_org-v1_2')->with(compact(['org']));
    }

    /**
     * 分享机构详情
     */
    public function share_org_v1_5($id)
    {
        $org = BankeOrg::find($id);
        return view('web.org.share_org-v1_5')->with(compact(['org']));
    }

    /**评论分享页面**/
    public function share_comment_org_v1_5($courseid,$uid,$comment_id)
    {
        $org = BankeCourse::find($courseid)->org;
        $shareInfo=Array('type_id'=>2,'comment_id'=>$comment_id,'uid'=>$uid);
        return view('web.org.share_comment_org-v1_5')->with(compact(['org','uid','shareInfo']));
    }

    /**申请入驻机构页面**/
    public function org_applyfor_v1_5()
    {
        return view('web.orgapplyfor.orgapplyfor-v1_5');
    }


    /**
     * 机构宣传页面详情
     */
    public function org_publicity_v1_6($id)
    {
        $org = BankeOrg::find($id);
        $superiorOrg=OrgSummaryRepository::getSuperiorOrgs(8)->get();
        return view('web.orgpublicity.orgpublicity-v1_6')->with(compact(['org','surperiorOrg']));
    }


    /**
     * 半课宣传页面详情
     */
    public function banke_publicity_v1_6()
    {
        $superiorOrg=OrgSummaryRepository::getSuperiorOrgs(4);
        return view('web.orgpublicity.bankepublicity-v1_6')->with(compact(['superiorOrg']));
    }



    /**添加入驻机构**/
    public function addOrgApplyFor(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'city' => 'required',
            'name'=>'required',
            'contact'=>'required',
            'tel_phone'=>'required',
            'address'=>'required',
//            'introduce'=>'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $sss='';
            foreach ($errors->all() as $message) {
                $sss.=$message;
            }
            return response()->json(['msg' => $sss, 'status' => false]);
        }
        $repository = new  OrgApplyForRepository();
        $result = $repository->addOrgApplyFor($request);
        if(!$result['status']){
            return response()->json($result);
        }else{
            return response()->json(['msg' => '机构申请添加成功', 'status' => true]);
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
                'template' => '获取精选机构失败',
                'status' => false
            ];
            return ApiResponseService::showError(Code::VERIFY_SMSID_ERROR, $param);
        }
    }

    /**获得入驻机构的具体信息**/
    public function getOrgDetail($id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => '机构id不能为空', 'status' => false]);
        }
        $request = $request->all();
        $id = $request['mobile'];
        try {
            $repository = new OrgRepository();
            $org = $repository->getDetail($id);
            $param = [
                'data' => $org,
                'template' => '获取机构信息成功',
                'status' => true
            ];
            return ApiResponseService::success('', Code::SUCCESS, $param);
        }
        catch (ClientException $e) {
            $param = [
                'template' => '获选机构信息失败',
                'status' => false
            ];
            return ApiResponseService::showError(Code::VERIFY_SMSID_ERROR, $param);
        }
    }


}
