<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Banke\BankeOrg;
use App\Http\Requests\OrgRebatesRequest;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use OrgRebatesRepository;
use PermissionRepository;
use RoleRepository;
use Illuminate\Support\Facades\Log;

class OrgRebatesController extends Controller
{
	/**
     * 提现列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.orgrebates.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = OrgRebatesRepository::ajaxIndex();
        return response()->json($data);
    }
    /**
     * 添加机构视图
     * @author 晚黎
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $org = new BankeOrg;
        $orgs = $org->where('status', 1)->orderBy('sort', 'desc')->get(['id', 'name']);
        return view('admin.orgrebates.create')->with(compact(['orgs']));
    }

    /**
     * 添加机构
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(OrgRebatesRequest $request)
    {
        OrgRebatesRepository::store($request);
        return redirect('admin/orgrebates');
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
        $orgrebates = OrgRebatesRepository::edit($id);
        return view('admin.orgrebates.edit')->with(compact('orgrebates'));
    }
    /**
     * 修改机构资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(OrgRebatesRequest $request,$id)
    {
        OrgRebatesRepository::update($request,$id);
        return redirect('admin/orgrebates');
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
        OrgRebatesRepository::destroy($id);
        return redirect('admin/orgrebates');
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
        $orgrebates = OrgRebatesRepository::show($id);
        return view('admin.orgrebates.show')->with(compact('orgrebates'));
    }
}
