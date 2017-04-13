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
        return view('web.org.share_org.v1.2')->with(compact(['org']));
    }


    /**添加入驻机构**/
    public function addOrgApplyFor(Request $request)
    {
        Log::info('---------in----------');
        $validator = Validator::make($request->all(), [
            'city' => 'required',
            'name'=>'required',
            'contact'=>'required',
            'tel_phone'=>'required',
            'address'=>'required',
            'introduce'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => '字段信息不能为空', 'status' => false]);
        }
        $request = $request->all();
        Log::info('---------'+$request['name']+'----------');
        $repository = new  OrgApplyForRepository();
        $result = $repository->addOrgApplyFor($request);
        if(!$result['status']){
            return response()->json($result);
        }else{
            return response()->json(['msg' => '机构申请添加成功', 'status' => true]);
        }
    }
}
