<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeCourse;
use App\Repositories\admin\OrgRepository;
use App\Repositories\admin\OrgApplyForRepository;
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

}
