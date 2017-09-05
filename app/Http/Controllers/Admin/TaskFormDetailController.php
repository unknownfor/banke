<?php
/**
* 新版任务期数控制器
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banke\BankeTask;
use TaskFormDetailRepository;
use App\Models\Banke\BankeTaskFormDetail;
use Illuminate\Http\Request;
use App\Http\Requests\TaskFormDetailRequest;
use Flash;

class TaskFormDetailController extends Controller {


    /**
     * 列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.taskformdetail.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = TaskFormDetailRepository::ajaxIndex();
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
        $alltask=BankeTask::get(['name','type']);
        return view('admin.taskformdetail.create')->with(compact(['alltask']));
    }

    /**
     * 添加活动
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(TaskFormDetailRequest $request)
    {
        TaskFormDetailRepository::store($request);
        return redirect('admin/taskformdetail');
    }


    /**
     * 修改活动视图
     * @author 晚黎
     * @date   2016-04-14T15:01:16+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $taskformdetail = TaskFormDetailRepository::edit($id);
        return view('admin.taskformdetail.edit')->with(compact(['taskformdetail']));
    }


    /**
     * 修改活动资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(TaskFormDetailRequest $request,$id)
    {
        TaskFormDetailRepository::update($request,$id);
        return redirect('admin/taskformdetail');
    }

    /**
     * 修改用户状态
     * @author 晚黎
     * @date   2016-04-14T11:50:04+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark($id,$status)
    {
        TaskFormDetailRepository::mark($id,$status);
        return redirect('admin/taskformdetail');
    }

    /**
     * 删除用户
     * @author 晚黎
     * @date   2016-04-14T11:52:40+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        TaskFormDetailRepository::destroy($id);
        return redirect('admin/taskformdetail');
    }

    /**
     * 查看活动信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function show($id)
    {
        $org = TaskFormDetailRepository::show($id);
        return view('admin.taskformdetail.show')->with(compact('org'));
    }
}
