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
use OrgRepository;
use EnrolRepository;
use CommentCourseRepository;
use CommentOrgRepository;
use GroupbuyingRepository;

class OrgController extends Controller
{

    /**获得Token**/
    public function getOrgBasicInfoById($id)
    {
        try {
            $info=[];
            $org = OrgRepository::show($id);
            if (Count($org)>0) {
                $info['name']=$org['name'];
                $info['logo']=$org['logo'];
                $info['appointmentCounts']=EnrolRepository::getEnrolCountsByOrgId($id);
                $count1=CommentCourseRepository::getViewsCountsByOrgId($id);
                $count2=CommentOrgRepository::getViewsCountsByOrgId($id);
                $count3=GroupbuyingRepository::getViewsCountsByOrgId($id);
                $info['viewCounts']=$count1+$count2+$count3;

                $result=['orgInfo'=>$info];
                return ApiResponseService::success($result, Code::SUCCESS, '机构信息查询成功');
            } else {
                return ApiResponseService::showError(Code::ORG_ERROR);
            }
        }
        catch (ClientException $e) {
                return ApiResponseService::showError(Code::ORG_ERROR);
            }
    }
}
