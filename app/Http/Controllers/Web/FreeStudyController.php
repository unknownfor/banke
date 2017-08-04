<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use OrgRepository;
use ActivityRepository;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class FreeStudyController extends Controller
{
    /**
    * 免费学详情
    */
    public function v1_8($id)
    {
        return view('web.freestudy.v1_8');
    }


    /**
     * 免费学详情
     */
    public function share_v1_8($id)
    {
        return view('web.freestudy.share_v1_8');
    }
}
