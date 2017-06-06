<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\FaqRequest;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use FaqRepository;
use PermissionRepository;
use RoleRepository;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
	/**
     * 提现列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.faq.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = FaqRepository::ajaxIndex();
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
        $permissions = PermissionRepository::findPermissionWithArray();
        $roles = RoleRepository::findRoleWithObject();
        return view('admin.faq.create')->with(compact(['permissions','roles']));
    }

    /**
     * 添加机构
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(FaqRequest $request)
    {
        FaqRepository::store($request);
        return redirect('admin/faq');
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
        $faq = FaqRepository::edit($id);
        return view('admin.faq.edit')->with(compact('faq'));
    }
    /**
     * 修改机构资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(FaqRequest $request,$id)
    {
        FaqRepository::update($request,$id);
        return redirect('admin/faq');
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
        FaqRepository::destroy($id);
        return redirect('admin/faq');
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
        $faq = FaqRepository::show($id);
        return view('admin.faq.show')->with(compact('faq'));
    }
}
