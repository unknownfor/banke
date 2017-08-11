<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\FreeStudyRequest;
use FreeStudyRepository;
use PermissionRepository;
use RoleRepository;

use Illuminate\Support\Facades\Log;

class FreeStudyController extends Controller
{
	/**
     * 反馈列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.freestudy.list');
    }

    /**
     * datatable 获取反馈数据
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
     * 删除反馈
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
     * 查看反馈信息
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
     * 修改反馈信息
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
     * 保存修改反馈信息
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
}
