<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use OrgRepository;
use ActivityRepository;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
    * 活动详情
    */
    public function v1_8($id)
    {
        return view('web.activity.v1_8');
    }


    /**
     * 分享活动详情
     */
    public function share_v1_8($id)
    {
        return view('web.activity.share_v1_8');
    }
}
