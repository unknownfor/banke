<?php
/**
* 新版任务期数控制器
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use TaskFormRepository;
use App\Models\Banke\BankeTaskForm;
use Illuminate\Http\Request;
use App\Http\Requests\TaskFormRequest;
use Flash;

class TaskFormController extends Controller {


    /**
     * 列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.taskform.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = TaskFormRepository::ajaxIndex();
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
        return view('admin.taskform.create');
    }

    /**
     * 添加活动
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(TaskFormRequest $request)
    {
        TaskFormRepository::store($request);
        return redirect('admin/taskform');
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
        $taskform = TaskFormRepository::edit($id);
        return view('admin.taskform.edit')->with(compact(['taskform']));
    }


    /**
     * 修改活动资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(TaskFormRequest $request,$id)
    {
        TaskFormRepository::update($request,$id);
        return redirect('admin/taskform');
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
        TaskFormRepository::mark($id,$status);
        return redirect('admin/taskform');
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
        TaskFormRepository::destroy($id);
        return redirect('admin/taskform');
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
        $org = TaskFormRepository::show($id);
        return view('admin.taskform.show')->with(compact('org'));
    }

    /**
     * 查看活动信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function getTaskFormByUserType()
    {
        $user_type=request('user_type','');
        $data = TaskFormRepository::getTaskFormByUserType($user_type);
        return response()->json($data);
    }
}
