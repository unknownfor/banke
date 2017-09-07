<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Lib\Code;
use CommentOrgRepository;
use CommentOrgUsersRepository;
use App\Models\Banke\BankeCommentOrg;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;

class CommentOrgController extends Controller
{

    /**
     * 机构评论
     */
    public function share_v1_9($id,$form_user_detail_id)
    {
        $comment = BankeCommentOrg::find($id);
        $user_name = $comment->authenUser['real_name'];
        if($user_name == null) {
            $user_name = $comment->user['name'];
        }
        $user=array(
            'avatar'=>$comment->user['avatar'],
            'name'=>$user_name,
            'get_do_task_amount'=>$comment->user['get_do_task_amount'],
            'user_id'=>$comment->user['uid']
        );
        $org=$comment->org;
        $course=null;

        return view('web.commentorg.share_v1_9')->with(compact(['comment','user','org','course','form_user_detail_id']));
    }
}
