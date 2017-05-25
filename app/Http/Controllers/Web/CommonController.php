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
use App\Repositories\admin\CommentCourseRepository;
use App\Repositories\admin\CommentOrgRepository;
use App\Repositories\admin\GroupbuyingRepository;

class CommonController extends Controller
{
    /**获得Token**/
    public function getToken()
    {
        $token=csrf_token();
        return $token;
    }

    /*更新相关记录的浏览量*/
    public function updateViewCounts_v1_5(Request $request){
        $request=$request->all();
        $type=$request['type'];
        $id=$request['id'];
        switch($type){
            case 1://课程评论
                CommentCourseRepository::updateViewCounts($id);
                break;
            case 2://机构评论
                CommentOrgRepository::updateViewCounts($id);
                break;
            case 3://开团分享
                GroupbuyingRepository::updateViewCounts($id);
                break;
            default:
                break;
        }
    }
}
