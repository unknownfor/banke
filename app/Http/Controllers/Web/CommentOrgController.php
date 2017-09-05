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
    public function share_v1_9($id)
    {
        $comment=BankeCommentOrg::find($id);
//        $uid=
//        data-uid="{{$user['uid']}}"
//         data-course-id="{{$course['id']}}"
//         data-org-id="{{$org['id']}}"
//         data-record-id="{{$shareInfo['record_id']}}"
//         data-type-id="{{$shareInfo['type_id']}}"
        return view('web.commentorg.share_v1_9')->with(compact(['comment']));
    }
}
