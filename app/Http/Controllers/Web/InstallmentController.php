<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use OrgRepository;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    /**
    * 分期详情
    */
    public function installment_v1_8($id)
    {
        return view('web.installment.installment-v1_8');
    }


    /**
     * 分享分期详情
     */
    public function share_installment_v1_8($id)
    {
        return view('web.installment.share_installment-v1_8');
    }
}
