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

}
