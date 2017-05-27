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
use Mockery\CountValidator\Exception;
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
        $type=$request['typeid'];
        $id=$request['id'];
        $param = [
            'data' => null,
            'template' => '更新页面浏览量信息成功',
            'status' => true
        ];
        if(id==0){
            return ApiResponseService::success('', Code::SUCCESS, $param);
        }

        try {
            switch ($type) {
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

        }catch (Exception $e){
            Flash::error('更新页面浏览量信息失败');
            $param = [
                'data' => null,
                'template' => '更新页面浏览量信息失败',
                'status' => false
            ];
        }
        return ApiResponseService::success('', Code::SUCCESS, $param);
    }
}
