<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Lib\Code;
use OrgRepository;
use CommentCourseRepository;
use CommentCourseUsersRepository;
use App\Models\Banke\BankeCommentCourse;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;

class CommentCourseController extends Controller
{

    /**
     * 心得
     */
    public function share_v1_9($id)
    {
        $comment = BankeCommentCourse::find($id);
        $user_name = $comment->authenUser['real_name'];
        if($user_name == null) {
            $user_name = $comment->user['name'];
        }
        $user=array(
            'avatar'=>$comment->user['avatar'],
            'name'=>$user_name,
            'get_do_task_amount'=>$comment->user['get_do_task_amount']
        );

        $course=$comment->course;
        $category=$course->category;
        $org=$course->org;
//        $org->org_name=$org;

        return view('web.commentcourse.share_v1_9')->with(compact(['comment','user','org','course']));
    }
}
