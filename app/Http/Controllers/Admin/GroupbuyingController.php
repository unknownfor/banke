<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use PermissionRepository;
use RoleRepository;
use GroupbuyingRepository;
use Illuminate\Support\Facades\Log;
use App\Models\Banke\BankeCourse;

class GroupbuyingController extends Controller
{
	/**
     * 团购列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        $allCourse=BankeCourse::where('status',1)->get(['id','name']);
        return view('admin.groupbuying.list')->with(compact(['allCourse']));
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = GroupbuyingRepository::ajaxIndex();
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
//        return view('admin.org.create')->with(compact(['permissions','roles']));
    }

    /**
     * 添加机构
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(Request $request)
    {
        GroupbuyingRepository::store($request);
        return redirect('admin/withdraw');
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
        $groupbuying = GroupbuyingRepository::edit($id);
        return view('admin.groupbuying.edit')->with(compact('groupbuying'));
    }
    /**
     * 修改机构资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(Request $request,$id)
    {
        GroupbuyingRepository::update($request,$id);
        return redirect('admin/groupbuying');
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
        GroupbuyingRepository::destroy($id);
        return redirect('admin/groupbuying');
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
        $groupbuying = GroupbuyingRepository::show($id);
        return view('admin.groupbuying.show')->with(compact('groupbuying'));
    }
}
