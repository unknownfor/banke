<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\ReportRequest;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use ReportRepository;
use PermissionRepository;
use RoleRepository;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
	/**
     * 媒体报道列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {

        return view('admin.report.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = ReportRepository::ajaxIndex();
        return response()->json($data);
    }
    /**
     * 添加媒体报道视图
     * @author 晚黎
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $permissions = PermissionRepository::findPermissionWithArray();
        $roles = RoleRepository::findRoleWithObject();
        return view('admin.report.create')->with(compact(['permissions','roles']));
    }

    /**
     * 添加媒体报道
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(ReportRequest $request)
    {
        ReportRepository::store($request);
        return redirect('admin/report');
    }

    /**
     * 修改媒体报道视图
     * @author 晚黎
     * @date   2016-04-14T15:01:16+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $report = ReportRepository::edit($id);
        return view('admin.report.edit')->with(compact('report'));
    }
    /**
     * 修改媒体报道资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(ReportRequest $request,$id)
    {
        ReportRepository::update($request,$id);
        return redirect('admin/report');
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
        ReportRepository::destroy($id);
        return redirect('admin/report');
    }

    /**
     * 查看媒体报道信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function show($id)
    {
        $report = ReportRepository::show($id);
        return view('admin.report.show')->with(compact('report'));
    }
}
