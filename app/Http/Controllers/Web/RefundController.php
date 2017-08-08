<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use OrgRepository;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    /**
    * 退款详情
    */
    public function refund_v1_8($id)
    {
        return view('web.refund.refund-v1_8');
    }


}
