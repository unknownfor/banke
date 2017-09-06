<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeMoneyStrategy;
use MoneyStrategyRepository;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class MoneyStrategyController extends Controller
{
    /**
     * 赚钱攻略详情
     */
    public function money_strategy_v1_7($id)
    {
        $strategy = BankeMoneyStrategy::find($id);
        return view('web.moneystrategy.moneystrategy_v1_7')->with(compact(['strategy']));
    }

    /**
     * 分享详情
     */
    public function share_money_strategy_v1_7($id)
    {
        $strategy = BankeMoneyStrategy::find($id);
        return view('web.moneystrategy.share_moneystrategy_v1_7')->with(compact(['strategy']));
    }

    /**
     * 分享赚钱攻略
     * @param $id 赚钱攻略表记录id
     * @param $record_id 优秀文章
     * @param $uid
     * @return $this
     */
    public function share_v1_9($id,$record_id,$uid)
    {
        $strategy = BankeMoneyStrategy::find($id);
        return view('web.moneystrategy.share_v1_9')->with(compact(['strategy','uid']));
    }
}
