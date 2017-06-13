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

class AboutController extends Controller
{
    /**
     * 半课
     */
    public function about()
    {
        return view('web.about.about');
    }
}
