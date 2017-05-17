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

class CommonController extends Controller
{
    /**获得Token**/
    public function getToken()
    {
        $token=csrf_token();
        return $token;
    }

    /*更新相关记录的浏览量*/
    public function updateViewCounts($ype,$id){

    }
}
