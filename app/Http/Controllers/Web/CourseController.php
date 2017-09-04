<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeUserProfiles;
use App\Repositories\admin\EnrolRepository;
use App\Repositories\admin\OrgRepository;
use CommentOrgRepository;
use TeachingTeacherRepository;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
 * 课程详情
 */
    public function course_v1_2($id)
    {
        $course = BankeCourse::find($id);
        $org = $course->org;
        return view('web.course.course-v1_2')->with(compact(['course','org']));
    }


    /**
     * 分享机构详情
     */
    public function share_course_v1_2($id)
    {
        $course = BankeCourse::find($id);
        $org = $course->org;
        return view('web.course.share_course-v1_2')->with(compact(['course','org']));
    }

    /**
     * 课程详情
     */
    public function course_v1_5($id)
    {
        $course = BankeCourse::find($id);
        $org = $course->org;
        $course['share_award']=$course['share_group_buying_award']+$course['share_comment_course_award']+$org['share_comment_org_award'];
        $course['max_award']=$course['share_award']  +$course['checkin_award'] + $course['group_buying_award'];
        return view('web.course.course-v1_5')->with(compact(['course','org']));
    }


    /**
     * 分享机构详情
     */
    public function share_course_v1_5($id)
    {
        $course = BankeCourse::find($id);
        $org = $course->org;
        $course['share_award']=$course['share_group_buying_award']+$course['share_comment_course_award']+$org['share_comment_org_award'];
        $course['max_award']=$course['share_award']+$course['checkin_award']+$course['group_buying_award'];
        return view('web.course.share_course-v1_5')->with(compact(['course','org']));
    }


    /**
     * 课程详情
     */
    public function course_v1_6($id)
    {
        $course = BankeCourse::find($id);
        $org = $course->org;
        $course['share_award']=$course['share_group_buying_award']+$course['share_comment_course_award']+$org['share_comment_org_award'];
        $course['max_award']=$course['share_award']  +$course['checkin_award'] + $course['group_buying_award'];
        $userInfo=$this->getRandomUserInfo();
        $number = rand(3, 5);
        return view('web.course.course-v1_6')->with(compact(['course','org','userInfo','number']));
    }

    /**
     * 课程详情
     */
    public function course_v1_7($id,$uid)
    {
        $course = BankeCourse::find($id);
        $org = $course->org;
        $course['share_award']=$course['share_group_buying_award']+$course['share_comment_course_award']+$org['share_comment_org_award'];
        $course['max_award']=$course['share_award']  +$course['checkin_award'] + $course['group_buying_award'];
        $userInfo=$this->getRandomUserInfo();
        $number = rand(3, 5);
        $currentUserType=BankeUserProfiles::find($uid)['user_type'];
        return view('web.course.course-v1_7')->with(compact(['course','org','userInfo','number','currentUserType']));
    }


    /**
     * 分享机构详情
     */
    public function share_course_v1_7($id)
    {
        $course = BankeCourse::find($id);
        $org = $course->org;
        $course['share_award']=$course['share_group_buying_award']+$course['share_comment_course_award']+$org['share_comment_org_award'];
        $course['max_award']=$course['share_award']+$course['checkin_award']+$course['group_buying_award'];
        return view('web.course.share_course-v1_7')->with(compact(['course','org']));
    }



    /**
     * 1.8课程详情
     */
    public function course_v1_8($id)
    {
        $course = BankeCourse::find($id);
        $org = $course->org;
        $course['share_award']=$course['share_group_buying_award']+$course['share_comment_course_award']+$org['share_comment_org_award'];
        $course['max_award']=$course['share_award']  +$course['checkin_award'] + $course['group_buying_award'];
        $userInfo=$this->getRandomUserInfo();
        $number = rand(3, 5);
        return view('web.course.course-v1_8')->with(compact(['course','org','userInfo','number']));
    }

    /**
     * 1.8分享课程详情详情
     */
    public function share_course_v1_8($id)
    {
        $course = BankeCourse::find($id);
        $subOrg = $course->org;
        $course['share_award']=$course['share_group_buying_award'] + $course['share_comment_course_award'] + $subOrg['share_comment_org_award'];
        $course['max_award']=($course['share_award']+$course['checkin_award']+$course['group_buying_award'])/100 * $course['price'];
        $course['max_award']= floor($course['max_award']);
        $org_summary=$subOrg->orgsummary;

        $org_teachers =TeachingTeacherRepository::getTeachersByOrgSummaryId($org_summary['id']);

        $fake_user_info=$this->getRandomUserInfo();
        $fake_number = rand(3, 5);

        $real_enrol_counts_course=EnrolRepository::getEnrolCountsByCourseId($id);   //课程真实预约人数
        $course['fake_enrol_counts']=$course['fake_enrol_counts'] + $real_enrol_counts_course;

        $real_enrol_counts_org=EnrolRepository::getEnrolCountsByOrgSummaryId($org_summary['id']);   //机构真实预约人数
        $org_summary['fake_enrol_counts']=$org_summary['fake_enrol_counts'] + $real_enrol_counts_org;

        //评论信息
        $comments=CommentOrgRepository::getAllCommentsByOrgSummaryId($org_summary['id']);
        $link_base_url='http://'.env('ADMIN_DOMAIN');
        return view('web.course.share_course-v1_8')->with(compact([
            'course',
            'org_summary',
            'fake_user_info',
            'fake_number',
            'org_teachers',
            'comments'
        ]));
    }

    /**
     * 1.8分享课程详情详情
     */
    public function share_course_v1_9($id)
    {
        $course = BankeCourse::find($id);
        $subOrg = $course->org;
        $course['share_award']=$course['share_group_buying_award'] + $course['share_comment_course_award'] + $subOrg['share_comment_org_award'];
        $course['max_award']=($course['share_award']+$course['checkin_award']+$course['group_buying_award'])/100 * $course['price'];
        $course['max_award']= floor($course['max_award']);
        $org_summary=$subOrg->orgsummary;

        $org_teachers =TeachingTeacherRepository::getTeachersByOrgSummaryId($org_summary['id']);

        $fake_user_info=$this->getRandomUserInfo();
        $fake_number = rand(3, 5);

        $real_enrol_counts_course=EnrolRepository::getEnrolCountsByCourseId($id);   //课程真实预约人数
        $course['fake_enrol_counts']=$course['fake_enrol_counts'] + $real_enrol_counts_course;

        $real_enrol_counts_org=EnrolRepository::getEnrolCountsByOrgSummaryId($org_summary['id']);   //机构真实预约人数
        $org_summary['fake_enrol_counts']=$org_summary['fake_enrol_counts'] + $real_enrol_counts_org;

        //评论信息
        $comments=CommentOrgRepository::getAllCommentsByOrgSummaryId($org_summary['id']);
        $link_base_url='http://'.env('ADMIN_DOMAIN');
        return view('web.course.share_course-v1_9')->with(compact([
            'course',
            'org_summary',
            'fake_user_info',
            'fake_number',
            'org_teachers',
            'comments'
        ]));
    }


    public function getRandomUserInfo()
    {
        $allUserInfo=[
            ['name'=>'晗愿倾心','img'=>'http://pic.hisihi.com/2017-06-20/1497929129003285.png'],
            ['name'=>'彡渣男','img'=>'http://pic.hisihi.com/2017-06-20/1497929129104743.jpeg'],
            ['name'=>'张舒舒y','img'=>'http://pic.hisihi.com/2017-06-20/1497929129207809.jpeg'],
            ['name'=>'_阳光下的彷徨','img'=>'http://pic.hisihi.com/2017-06-20/1497929129311466.jpeg'],
            ['name'=>'慕12思PO','img'=>'http://pic.hisihi.com/2017-06-20/1497929129420966.jpeg'],
            ['name'=>'收集金币','img'=>'http://pic.hisihi.com/2017-06-20/1497929129795627.jpeg'],
            ['name'=>'愿港闹闹','img'=>'http://pic.hisihi.com/2017-06-20/1497929129900223.jpeg'],
            ['name'=>'郭较瘦c','img'=>'http://pic.hisihi.com/2017-06-20/1497929130001584.jpeg'],
            ['name'=>'白野猪暴金条','img'=>'http://pic.hisihi.com/2017-06-20/1497929130199840.jpeg'],
            ['name'=>'异想大同','img'=>'http://pic.hisihi.com/2017-06-20/1497929130100387.jpeg'],
            ['name'=>'无名字2323','img'=>'http://pic.hisihi.com/2017-06-20/1497929130299519.jpeg'],
            ['name'=>'2薛世界和平','img'=>'http://pic.hisihi.com/2017-06-20/1497929100416721.jpeg'],
            ['name'=>'小先生237','img'=>'http://pic.hisihi.com/2017-06-20/1497929130400349.jpeg'],
            ['name'=>'帅比何某250','img'=>'http://pic.hisihi.com/2017-06-20/1497929100531458.jpeg'],
            ['name'=>'这波要出大事丶','img'=>'http://pic.hisihi.com/2017-06-20/1497929100644572.jpeg'],
            ['name'=>'普通的树枝','img'=>'http://pic.hisihi.com/2017-06-20/1497929100742407.jpeg'],
            ['name'=>'亲爱的司马懿','img'=>'http://pic.hisihi.com/2017-06-20/1497929100844397.jpeg'],
            ['name'=>'勤奋的gggg1230','img'=>'http://pic.hisihi.com/2017-06-20/1497929101097942.jpeg'],
            ['name'=>'你最近失眠吗','img'=>'http://pic.hisihi.com/2017-06-20/1497929101214455.jpeg'],
            ['name'=>'我是你爸爸UY','img'=>'http://pic.hisihi.com/2017-06-20/1497929101317951.jpeg'],
            ['name'=>'找天使借阳光','img'=>'http://pic.hisihi.com/2017-06-20/1497929101473687.jpeg'],
            ['name'=>'a820417312','img'=>'http://pic.hisihi.com/2017-06-20/1497929101576693.jpeg'],
            ['name'=>'壊壊易先说','img'=>'http://pic.hisihi.com/2017-06-20/1497929101682964.jpeg'],
            ['name'=>'致DOTA_永哉','img'=>'http://pic.hisihi.com/2017-06-20/1497929101784360.jpeg'],
            ['name'=>'xiacheng30525','img'=>'http://pic.hisihi.com/2017-06-20/1497929101889924.jpeg'],
            ['name'=>'人穷志不短哎','img'=>'http://pic.hisihi.com/2017-06-20/1497929101991328.jpeg'],
            ['name'=>'桃花源记','img'=>'http://pic.hisihi.com/2017-06-20/1497929102091495.jpeg'],
            ['name'=>'Zk贤子','img'=>'http://pic.hisihi.com/2017-06-20/1497929102195672.jpeg'],
            ['name'=>'简简单单的块乐','img'=>'http://pic.hisihi.com/2017-06-20/1497929102299519.jpeg'],
        ];
        $count=Count($allUserInfo);
        $index = rand(0, $count-1);
        $user = $allUserInfo[$index];
        return $user;
    }


    /**
     * 分享机构详情
     */
    public function share_course_v1_6($id)
    {
        $course = BankeCourse::find($id);
        $org = $course->org;
        $course['share_award']=$course['share_group_buying_award']+$course['share_comment_course_award']+$org['share_comment_org_award'];
        $course['max_award']=$course['share_award']+$course['checkin_award']+$course['group_buying_award'];
        return view('web.course.share_course-v1_6')->with(compact(['course','org']));
    }

    public function imgdetails_course_v1_8($id){
        $course = BankeCourse::find($id);
        return view('web.course.course_imgdetails-v1_8')->with(compact(['course']));
    }

}
