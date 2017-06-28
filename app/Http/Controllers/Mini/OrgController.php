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
use CourseRepository;
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
                    'appointmentCounts'=>EnrolRepository::getEnrolCountsByOrgId($id),
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
                    'shareCounts' =>  $groupbuying['counts'] + $commentCourse['counts'] + $commentOrg['counts'],
                    'appointmentCounts'=>EnrolRepository::getEnrolCountsByOrgId($id)
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
    private static function getTotalViewCounts($id)
    {
        $count1=CommentCourseRepository::getCountInfoByOrgId($id)['viewCounts'];
        $count2=CommentOrgRepository::getCountInfoByOrgId($id)['viewCounts'];
        $count3=GroupbuyingRepository::getCountInfoByOrgId($id)['viewCounts'];
        return $count1+$count2+$count3;

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

    /*
    * 得到预约详情
    * */
    public function getDetailAppointmentInfoByOrgId($id,$pageIndex=0,$perCounts=20)
    {
        try {
            $info=EnrolRepository::getDetailInfoByOrgId($id,$pageIndex,$perCounts);
            $result=['detailInfo'=>$info];
            return ApiResponseService::success($result, Code::SUCCESS, '预约信息查询成功');
        }
        catch (ClientException $e) {
            return ApiResponseService::showError(Code::ORG_ERROR);
        }
    }

    /*
    * 得到所有课程的曝光量详情
    * */
    public function getCourseViewsInfoByOrgId($id)
    {
        try {
            $info=CommentCourseRepository::getViewCountsInfoByOrgId($id);
            $result=['detailInfo'=>$info];
            return ApiResponseService::success($result, Code::SUCCESS, '课程曝光量信息查询成功');
        }
        catch (ClientException $e) {
            return ApiResponseService::showError(Code::ORG_ERROR);
        }
    }


    /*
    * 得到分享详情
    * */
    public function getShareInfoByOrgId($id,$pageIndex=0,$perCounts=100)
    {
        try {
            $arr1=CommentCourseRepository::getShareInfoByOrgId($id);
            $arr2=CommentOrgRepository::getShareInfoByOrgId($id);
            $info= $this->sortByTimeDesc($arr1,$arr2);
            $newArr= array_slice($info,$pageIndex*$perCounts,$perCounts);
            $tempArr=['record'=>$newArr,'total'=>Count($info)];
            $result=['detailInfo'=>$tempArr];
            return ApiResponseService::success($result, Code::SUCCESS, '分享详情信息查询成功');
        }
        catch (ClientException $e) {
            return ApiResponseService::showError(Code::ORG_ERROR);
        }
    }

    private function sortByTimeDesc($arr1,$arr2)
    {
        $arr = array_merge($arr1,$arr2);
        return $this->list_sort_by($arr, 'time', 'desc');
    }


    /**
     * 对查询结果集进行排序
     * @access public
     * @param array $list 查询结果
     * @param string $field 排序的字段名
     * @param string $sortby 排序类型 （asc正向排序 desc逆向排序 nat自然排序）
     * @return array
     */

    private function list_sort_by($list, $field, $sortby = 'desc')
    {
        if (is_array($list))
        {
            $refer = $resultSet = array();
            foreach ($list as $i => $data)
            {
                $refer[$i] = &$data[$field];
            }
            switch ($sortby)
            {
                case 'asc': // 正向排序
                    asort($refer);
                    break;
                case 'desc': // 逆向排序
                    arsort($refer);
                    break;
                case 'nat': // 自然排序
                    natcasesort($refer);
                    break;
            }
            foreach ($refer as $key => $val)
            {
                $resultSet[] = &$list[$key];
            }
            return $resultSet;
        }
        return false;
    }

}
