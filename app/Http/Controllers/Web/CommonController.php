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
use TaskFormUserRepository;
use TaskUserRepository;

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
        $code=Code::SUCCESS;
//        if($id==0 || !$id){
//            $param = [
//                'data' => null,
//                'template' => '更新页面浏览量信息失败,旧订单不提供开团功能',
//                'status' => false
//            ];
//            $code=Code::UPDATE_VIEW_COUNTS_ERROR;
//        }

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
                case 4://文章分享
                    $input=array(
                        'user_id'=>$request['uid'],
                        'task_id'=>9,  //分享文章
                        'source_Id'=>$request['record_id'],
                        'form_detail_user_id'=>$request['form_detail_user_id']
                    );
                    TaskUserRepository::updateViewCounts($input);
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
            $code=Code::UPDATE_VIEW_COUNTS_ERROR;
        }
        return ApiResponseService::success('', $code, $param);
    }
}
