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
    * 介绍详情
    */
    public function introduce_v1_8()
    {
        return view('web.marketingambassador.introduce_v1_8');
    }

    /**
     * 下载
     */
    public function download_v1_8($uid)
    {
        return view('web.marketingambassador.download_v1_8');
    }
}
