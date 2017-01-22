<?php
/**
 * 网站功能设置
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Facades\DictFacade;
use App\Http\Requests\DictRequest;
use AppUpdateRepository;
use Illuminate\Support\Facades\Log;

class AppUpdateController extends Controller {

    /**
     * 配置列表
     */
    public function index()
    {
        return view("admin.appUpdate.list");
    }

    /**
     * datatable 获取数据
     * @author shaolei
     * @date   2016-12-26T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = AppUpdateRepository::ajaxIndex();
        return response()->json($data);
    }

    /**
     * 添加【位置视图
     * @author shaolei
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        return view('admin.appUpdate.create');
    }

    /**
     * 添加配置
     * @author shaolei
     * @date   2016-04-13T11:26:35+0800
     * @param  DictRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(Request $request)
    {
        AppUpdateRepository::store($request);
        return redirect('admin/appUpdate');
    }

    /**
     * 修改配置视图
     * @author shaolei
     * @date   2016-04-13T11:26:42+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $appUpdate = AppUpdateRepository::edit($id);
        Log::info('$appUpdate===================='.json_encode($appUpdate));
        return view('admin.appUpdate.edit')->with(compact('appUpdate'));
    }
    /**
     * 修改配置
     * @author shaolei
     * @date   2016-04-13T11:26:57+0800
     * @param  DictRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(Request $request,$id)
    {
        AppUpdateRepository::update($request,$id);
        return redirect('admin/appUpdate');
    }

    /**
     * 修改配置状态
     * @author shaolei
     * @date   2016-04-13T11:27:23+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark($id,$status)
    {
        AppUpdateRepository::mark($id,$status);
        return redirect('admin/appUpdate');
    }

    /**
     * 删除配置
     * @author shaolei
     * @date   2016-04-13T11:27:34+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        AppUpdateRepository::destroy($id);
        return redirect('admin/appUpdate');
    }
}