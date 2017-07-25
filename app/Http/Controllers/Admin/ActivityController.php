<?php
/**
* 活动控制器
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use ActivityRepository;
use App\Http\Requests\ActivityRequest;
use Flash;

class ActivityController extends Controller {


    /**
     * 列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.activity.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = ActivityRepository::ajaxIndex();
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
        return view('admin.activity.create');
    }

    /**
     * 添加活动
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(Request $request)
    {
        ActivityRepository::store($request);
        return redirect('admin/activity');
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
        $activity = ActivityRepository::edit($id);
        return view('admin.activity.edit')->with(compact('activity'));
    }
    /**
     * 修改活动资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(Request $request,$id)
    {
        ActivityRepository::update($request,$id);
        return redirect('admin/activity');
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
        ActivityRepository::mark($id,$status);
        return redirect('admin/activity');
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
        ActivityRepository::destroy($id);
        return redirect('admin/activity');
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
        $org = ActivityRepository::show($id);
        return view('admin.activity.show')->with(compact('org'));
    }
}
