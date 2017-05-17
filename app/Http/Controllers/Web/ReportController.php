<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeDict;
use App\Repositories\admin\InvitationRepository;
use App\Repositories\admin;
use App\Services\ApiResponseService;
use App\Lib\Code;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;
use ReportRepository;

class ReportController extends Controller
{
    /**获得媒体报道**/
    public function getMediaReport()
    {
        try {
            $repository = new ReportRepository;
            $report = $repository->getTop5();
            $param = [
                'data' => $report,
                'template' => '媒体报道',
                'status' => true
            ];
            return ApiResponseService::success('', Code::SUCCESS, $param);
        }
        catch (ClientException $e) {
            $param = [
                'template' => '媒体报道失败',
                'status' => false
            ];
            return ApiResponseService::showError(Code::VERIFY_SMSID_ERROR, $param);
        }
    }
}
