<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use OrgRepository;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;
use App\Models\Banke\BankeCourse;

class InstallmentController extends Controller
{
    /**
    * 分期详情
    */
    public function installment_v1_8($id)
    {
        $org=BankeCourse::find($id)->org;
        $content=$org['installment_content'];
        return view('web.installment.installment-v1_8')->with(compact(['content']));
    }

}
