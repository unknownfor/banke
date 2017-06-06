<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use OrgApplyForRepository;
use App\Http\Requests\CreateOrgRequest;
use App\Http\Requests\UpdateOrgRequest;
use PermissionRepository;
use RoleRepository;
use Illuminate\Support\Facades\Log;

class OrgApplyForController extends Controller
{
	/**
     * 机构列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.orgapplyfor.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = OrgApplyForRepository::ajaxIndex();
        return response()->json($data);
    }



    /**
     * 修改机构视图
     * @author 晚黎
     * @date   2016-04-14T15:01:16+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $org = OrgApplyForRepository::edit($id);
        return view('admin.orgapplyfor.edit')->with(compact('org'));
    }
    /**
     * 修改机构资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(UpdateOrgRequest $request,$id)
    {
        OrgApplyForRepository::update($request,$id);
        return redirect('admin/orgapplyfor');
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
        OrgApplyForRepository::destroy($id);
        return redirect('admin/orgapplyfor');
    }

    /**
     * 查看机构信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function show($id)
    {
        $orgapplyfor = OrgApplyForRepository::show($id);
        OrgApplyForRepository::updateReadStatus($id);
        return view('admin.orgapplyfor.show')->with(compact('orgapplyfor'));
    }
}
