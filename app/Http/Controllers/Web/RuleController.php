<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeDict;
use App\Repositories\admin\InvitationRepository;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;
use UserRepository;

class RuleController extends Controller
{
    /**
     * 规则详情
     */
    public function rule_v1_2()
    {
        return view('web.rule.rule-v1_2');
    }

    /**
     * 规则详情
     */
    public function share_rule_v1_2()
    {
        return view('web.rule.share_rule-v1_2');
    }

}
