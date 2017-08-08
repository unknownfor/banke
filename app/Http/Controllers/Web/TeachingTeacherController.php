<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeUserProfiles;
use OrgRepository;
use OrgApplyForRepository;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class TeachingTeacherController extends Controller
{
    /**
    * 机构老师详情
    */
    public function teachingteacher_v1_8($id)
    {
        return view('web.teachingteacher.teachingteacher-v1_8');
    }

}
