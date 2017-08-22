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
use App\Models\Banke\BankeOrg;

class InstallmentController extends Controller
{
    /**
    * 分期详情传机构课程id
    */
    public function installment_v1_8($id)
    {
        $org=BankeCourse::find($id)->org;
        $content=$org['installment_content'];
        return view('web.installment.installment-v1_8')->with(compact(['content']));
    }

    /**
    * 分期详情传机构id
    */
    public function installment_oid_v1_8($id)
    {
        $org=BankeOrg::find($id);
        $content=$org['installment_content'];
        return view('web.installment.installment-v1_8')->with(compact(['content']));
    }

}
