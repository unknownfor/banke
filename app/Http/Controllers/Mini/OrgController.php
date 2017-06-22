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
use OrderRepository;
use OrderDepositRepository;
use CheckinRepository;

class OrgController extends Controller
{

    /**获得Token**/
    public function getOrgBasicInfoById($id)
    {
        try {
            $org = OrgRepository::show($id);
            if (Count($org)>0) {
                $info=[
                    'name'=>$org['name'],
                    'logo'=>$org['logo'],
                    'appointmentCounts'=>EnrolRepository::getEnrolCountsByOrgId($id) + $org['default_appointment_users_count'],
                    'viewCounts'=>self::getTotalViewCounts($id,$org),
                ];
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


    /**获得机构的统计数据**/
    public function getOrgStatisticInfoById($id)
    {
        try {
            $org = OrgRepository::show($id);
            if (Count($org)>0) {
                $order=OrderRepository::getOrderInfoByOrgId($id);
                $deposit=OrderDepositRepository::getOrderInfoByOrgId($id);
                $checkin=CheckinRepository::getTotalCountsByOrgId($id);
                $groupbuying=GroupbuyingRepository::getCountInfoByOrgId($id);
                $commentCourse=CommentCourseRepository::getCountInfoByOrgId($id);
                $commentOrg=CommentOrgRepository::getCountInfoByOrgId($id);

                $info=[
                    'viewCounts'=>self::getTotalViewCounts($id,$org),
                    'orderCounts'=>$order['counts'],
                    'account' => $order['account']+$deposit['account'],
                    'checkinCounts' => $checkin,
                    'groupbuyingCounts' => $groupbuying['counts'],
                    'shareCounts' =>  $groupbuying['counts'] + $commentCourse['counts'] + $commentOrg['counts'] + $org['default_share_count'],
                    'appointmentCounts'=>EnrolRepository::getEnrolCountsByOrgId($id) + $org['default_appointment_users_count']
                ];
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

    /*曝光量*/
    private static function getTotalViewCounts($id,$org)
    {
        $count1=CommentCourseRepository::getCountInfoByOrgId($id)['viewCounts'];
        $count2=CommentOrgRepository::getCountInfoByOrgId($id)['viewCounts'];
        $groupbuying=GroupbuyingRepository::getCountInfoByOrgId($id);
        $count3=$groupbuying['viewCounts'];
        return $count1+$count2+$count3+$org['default_browse_count'];

    }

    /*
     * 得到打卡详情
     * */
    public function getDetailCheckinInfoByOrgId($id,$pageIndex=0,$perCounts=20)
    {
        try {
            $info=CheckinRepository::getDetailInfoByOrgId($id,$pageIndex,$perCounts);
            $result=['detailInfo'=>$info];
            return ApiResponseService::success($result, Code::SUCCESS, '打卡信息查询成功');
        }
        catch (ClientException $e) {
            return ApiResponseService::showError(Code::ORG_ERROR);
        }
    }

    /*
    * 得到开团详情
    * */
    public function getDetailGroupbuyingInfoByOrgId($id,$pageIndex=0,$perCounts=20)
    {
        try {
            $info=GroupbuyingRepository::getDetailInfoByOrgId($id,$pageIndex,$perCounts);
            $result=['detailInfo'=>$info];
            return ApiResponseService::success($result, Code::SUCCESS, '开团信息查询成功');
        }
        catch (ClientException $e) {
            return ApiResponseService::showError(Code::ORG_ERROR);
        }
    }
}
