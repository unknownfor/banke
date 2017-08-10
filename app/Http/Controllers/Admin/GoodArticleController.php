<?php
/**
* 活动控制器
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use MoneyStrategyRepository;
use App\Models\Banke\BankeGoodArticle;
use Illuminate\Http\Request;
use App\Http\Requests\GoodArticleRequest;
use BusinessCityRepository;
use GoodArticleRepository;
use Flash;

class GoodArticleController extends Controller {


    /**
     * 列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.goodarticle.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = GoodArticleRepository::ajaxIndex();
        return response()->json($data);
    }

    /**
     * 添加活动
     * @author 晚黎
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $strategy=MoneyStrategyRepository::getAll();
        return view('admin.goodarticle.create')->with(compact(['strategy']));
    }

    /**
     * 添加
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(GoodArticleRequest $request)
    {
        $stragegy_id=$request->all()['strategy_id'];

        $stragegy = MoneyStrategyRepository::edit($stragegy_id);

        $input=[
            'title'=>$stragegy['title'],
            'cover'=>$stragegy['cover_img'],
            'intro'=>$stragegy['content'],
            'url'=>'http://'.$_SERVER['HTTP_HOST'].'/v1.7/web/monystrategy/'.$stragegy_id,
        ];
        GoodArticleRepository::store($input);
        return redirect('admin/goodarticle');
    }

    /**
     * 删除
     * @author 晚黎
     * @date   2016-04-14T11:52:40+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        GoodArticleRepository::destroy($id);
        return redirect('admin/goodarticle');
    }

}
