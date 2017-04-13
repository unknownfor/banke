<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeOrg;
use App\Repositories\admin\OrgRepository;
use App\Repositories\admin\OrgApplyForRepository;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    /**
     * 分享邀请注册
     */
    public function invitation($welcome)
    {

        return view('web.invite.invitation-v1_2')->with(compact(['welcome']));
    }

}
