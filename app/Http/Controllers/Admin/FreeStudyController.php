<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\FreeStudyRequest;
use FreeStudyRepository;
use FreeStudyUsersRepository;
use PermissionRepository;
use RoleRepository;

use Illuminate\Support\Facades\Log;

class FreeStudyController extends Controller
{
	/**
     * 免费学列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.freestudy.list');
    }

    /**
     * datatable 获取免费学数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = FreeStudyRepository::ajaxIndex();
        return response()->json($data);
    }

    /**
     * 免费学人员列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function users($id=0)
    {
        return view('admin.freestudy.users')->with(compact(['id']));
    }

    /**
     * datatable 获取免费学数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxUsersIndex()
    {
        $data = FreeStudyUsersRepository::ajaxIndex();
        return response()->json($data);
    }

    /**
     * 删除免费学
     * @author 晚黎
     * @date   2016-04-14T11:52:40+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {

        FreeStudyRepository::destroy($id);
        return redirect('admin/freestudy');

    }

    /**
     * 查看免费学信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function show($id)
    {
        $freestudy = FreeStudyRepository::show($id);
        return view('admin.freestudy.show')->with(compact('freestudy'));
    }

    /**
     * 修改免费学信息
     * @author shaolei
     * @date   2016-04-14T15:01:16+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $freestudy = FreeStudyRepository::edit($id);
        return view('admin.freestudy.edit')->with(compact('freestudy'));
    }

    /**
     * 保存修改免费学信息
     * @author shaolei
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */

    public function update(FreeStudyRequest $request,$id)
    {
        FreeStudyRepository::update($request,$id);
        return redirect('admin/freestudy');

    }
    /**
     * 添加免费学
     * @author jimmy
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        return view('admin.freestudy.create');
    }

    /**
     * 添加课程
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(FreeStudyRequest $request)
    {
        FreeStudyRepository::store($request);
        return redirect('admin/freestudy');
    }

}
