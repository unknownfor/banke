<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeMoneyStrategy;
use App\Models\Banke\BankeFreeStudy;
use MoneyStrategyRepository;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Validator;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * 文章地址来为 赚钱攻略
     * @param $id 赚钱攻略表记录id，用来查询内容
     * @param $record_id 优秀文章 表id 用来方便任务结算时查询文章来源
     * @param $uid 用户id
     * @return $this
     */
    public function moneystrategy_share_v1_9($id,$record_id,$uid,$form_user_detail_id)
    {
        $strategy = BankeMoneyStrategy::find($id);
        return view('web.moneystrategy.share_v1_9')->with(compact(['strategy','record_id','uid','form_user_detail_id']));
    }

    /**
     * 文章地址来为 免费学
     * @param $id 赚钱攻略表记录id，用来查询内容
     * @param $record_id 优秀文章 表id 用来方便任务结算时查询文章来源
     * @param $uid 用户id
     * @return $this
     */
    public function freestudy_share_v1_9($id,$record_id,$uid,$form_user_detail_id)
    {
        $freestudy = BankeFreeStudy::find($id);
        return view('web.freestudy.share_v1_9')->with(compact(['freestudy','record_id','uid','form_user_detail_id']));
    }

}
