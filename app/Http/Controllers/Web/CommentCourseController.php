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
        return view('web.commentcourse.share_v1_9')->with(compact(['comment']));
    }
}
