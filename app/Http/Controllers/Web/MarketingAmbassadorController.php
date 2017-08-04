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

class MarketingAmbassadorController extends Controller
{
    /**
    * 基本介绍详情
    */
    public function introduce_v1_8()
    {
        return view('web.marketingambassador.introduce_v1_8');
    }


    /**
     * 分享活动详情
     */
    public function share_v1_8($id)
    {
        return view('web.activity.share_v1_8');
    }
}
