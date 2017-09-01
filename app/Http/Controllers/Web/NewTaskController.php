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

class NewTaskController extends Controller
{
    /**
     * 规则
     */
    public function rule_v1_9()
    {
        return view('web.newtask.rule_v1_9');
    }
}
