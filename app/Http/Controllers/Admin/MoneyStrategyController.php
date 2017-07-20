<?php
/**
 * 赚钱攻略
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use MoneyStrategyRepository;
use App\Http\Requests\MoneyStrategyRequest;

class MoneyStrategyController extends Controller {

    /**
     * 赚钱攻略列表
     */
    public function index()
    {
        return view("admin.moneystrategy.list");
    }

    /**
     * datatable 获取数据
     * @author shaolei
     * @date   2016-12-26T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    { 
        $data = MoneyStrategyRepository::ajaxIndex();
        return response()->json($data);
    }

    /**
     * 添加视图
     * @author shaolei
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        return view('admin.moneystrategy.create');
    }

    /**
     * 添加赚钱攻略
     * @author shaolei
     * @date   2016-04-13T11:26:35+0800
     * @param  DictRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(MoneyStrategyRequest $request)
    {
        $input = $request->all();
        $user_types=$input['user_type'];
        $user_types_arr = explode(",",$user_types);
        if(Count($user_types_arr)>1){
            MoneyStrategyRepository::storeMultiple($request,$user_types_arr);
        }else{
            MoneyStrategyRepository::store($request);
        }
        return redirect('admin/moneystrategy');
    }

    /**
     * 修改赚钱攻略视图
     * @author shaolei
     * @date   2016-04-13T11:26:42+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $moneystrategy = MoneyStrategyRepository::edit($id);
        return view('admin.moneystrategy.edit')->with(compact(['moneystrategy']));
    }
    /**
     * 修改赚钱攻略
     * @author shaolei
     * @date   2016-04-13T11:26:57+0800
     * @param  DictRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(MoneyStrategyRequest $request,$id)
    {
        MoneyStrategyRepository::update($request,$id);
        return redirect('admin/moneystrategy');
    }

    /**
     * 修改赚钱攻略状态
     * @author shaolei
     * @date   2016-04-13T11:27:23+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark($id,$status)
    {
        MoneyStrategyRepository::mark($id,$status);
        return redirect('admin/moneystrategy');
    }

    /**
     * 删除赚钱攻略
     * @author shaolei
     * @date   2016-04-13T11:27:34+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        MoneyStrategyRepository::destroy($id);
        return redirect('admin/moneystrategy');
    }
}