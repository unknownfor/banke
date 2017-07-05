<?php
/**
 * 赚钱攻略
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use AlertBoxRepository;
use App\Http\Requests\AlertBoxRequest;

class AlertBoxController extends Controller {

    /**
     * app弹窗提示列表
     */
    public function index()
    {
        return view("admin.alertbox.list");
    }

    /**
     * datatable 获取数据
     * @author shaolei
     * @date   2016-12-26T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    { 
        $data = AlertBoxRepository::ajaxIndex();
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
        return view('admin.alertbox.create');
    }

    /**
     * 添加app弹窗提示
     * @author shaolei
     * @date   2016-04-13T11:26:35+0800
     * @param  DictRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(AlertBoxRequest $request)
    {  
        AlertBoxRepository::store($request);
        return redirect('admin/alertbox');
    }

    /**
     * 修改app弹窗提示视图
     * @author shaolei
     * @date   2016-04-13T11:26:42+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $alertbox = AlertBoxRepository::edit($id);
        return view('admin.alertbox.edit')->with(compact(['alertbox']));
    }
    /**
     * 修改app弹窗提示
     * @author shaolei
     * @date   2016-04-13T11:26:57+0800
     * @param  DictRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(AlertBoxRequest $request,$id)
    {
        AlertBoxRepository::update($request,$id);
        return redirect('admin/alertbox');
    }

    /**
     * 修改app弹窗提示状态
     * @author shaolei
     * @date   2016-04-13T11:27:23+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark($id,$status)
    {
        AlertBoxRepository::mark($id,$status);
        return redirect('admin/alertbox');
    }

    /**
     * 删除app弹窗提示
     * @author shaolei
     * @date   2016-04-13T11:27:34+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        AlertBoxRepository::destroy($id);
        return redirect('admin/alertbox');
    }
}