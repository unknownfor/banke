<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeCourse;
use App\Repositories\admin\OrgRepository;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class GroupbuyingController extends Controller
{
    /**
     * 开团详情
     */
    public function detailPage_v1_5($id=0)
    {
        return view('web.groupbuying/groupbuying-v1_5');
    }


}
