<?php
/**
 * 赚钱动态
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use MoneyNewsRepository;
use App\Http\Requests\MoneyNewsRequest;
use App\Models\Banke\Bankeorg;

class MoneyNewsController extends Controller {

    /**
     * 赚钱动态列表
     */
    public function index()
    {
        return view("admin.moneynews.list");
    }

    /**
     * datatable 获取数据
     * @author shaolei
     * @date   2016-12-26T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    { 
        $data = MoneyNewsRepository::ajaxIndex();
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
        $orgs = BankeOrg::where('status', 1)->get(['id', 'name','short_name']);
        return view('admin.moneynews.create')->with(compact(['orgs']));
    }

    /**
     * 添加赚钱动态
     * @author shaolei
     * @date   2016-04-13T11:26:35+0800
     * @param  DictRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(MoneyNewsRequest $request)
    {  
        MoneyNewsRepository::store($request);
        return redirect('admin/moneynews');
    }

    /**
     * 修改赚钱动态视图
     * @author shaolei
     * @date   2016-04-13T11:26:42+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $moneynews = MoneyNewsRepository::edit($id);
        return view('admin.moneynews.edit')->with(compact(['moneynews']));
    }
    /**
     * 修改赚钱动态
     * @author shaolei
     * @date   2016-04-13T11:26:57+0800
     * @param  DictRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(MoneyNewsRequest $request,$id)
    {
        MoneyNewsRepository::update($request,$id);
        return redirect('admin/moneynews');
    }

    /**
     * 修改赚钱动态状态
     * @author shaolei
     * @date   2016-04-13T11:27:23+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark($id,$status)
    {
        MoneyNewsRepository::mark($id,$status);
        return redirect('admin/moneynews');
    }

    /**
     * 删除赚钱动态
     * @author shaolei
     * @date   2016-04-13T11:27:34+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        MoneyNewsRepository::destroy($id);
        return redirect('admin/moneynews');
    }
}