<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\CreateDrawbackRequest;
use App\Http\Requests\UpdateDrawbackRequest;
use Illuminate\Http\Request;
use App\Models\Banke\BankeDrawback;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use DrawbackRepository;
use PermissionRepository;
use RoleRepository;
use Illuminate\Support\Facades\Log;

class DrawbackController extends Controller
{
	/**
     * 退款列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.drawback.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = DrawbackRepository::ajaxIndex();
        return response()->json($data);
    }
    /**
     * 添加退款视图
     * @author 晚黎
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $permissions = PermissionRepository::findPermissionWithArray();
        $roles = RoleRepository::findRoleWithObject();
        return view('admin.drawback.create')->with(compact(['permissions','roles']));
    }

    /**
     * 添加退款
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(CreateDrawbackRequest $request)
    {
        DrawbackRepository::store($request);
        return redirect('admin/drawback');
    }

    /**
     * 修改退款视图
     * @author 晚黎
     * @date   2016-04-14T15:01:16+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $drawback = DrawbackRepository::edit($id);
        return view('admin.drawback.edit')->with(compact('drawback'));
    }
    /**
     * 修改退款资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(UpdateDrawbackRequest $request,$id)
    {
        DrawbackRepository::update($request,$id);
        return redirect('admin/drawback');
    }

    /**
     * 查看退款信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function show($id)
    {
        $drawback = DrawbackRepository::show($id);
        return view('admin.drawback.show')->with(compact('drawback'));
    }

    /**
     * 删除退款
     * @author 晚黎
     * @date   2016-04-14T11:52:40+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        DrawbackRepository::destroy($id);
        return redirect('admin/drawback');
    }
}
