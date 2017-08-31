<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use ActivityRepository;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;
use App\Models\Banke\BankeActivity;

class RedPacketController extends Controller
{

    /**
     * 分享红包详情
     */
    public function share_v1_9($id)
    {
        return view('web.redpacket.share_v1_9');
    }
}
