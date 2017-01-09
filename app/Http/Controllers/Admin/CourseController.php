<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use CourseRepository;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use PermissionRepository;
use RoleRepository;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
	/**
     * 课程列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.course.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = CourseRepository::ajaxIndex();
        return response()->json($data);
    }
    /**
     * 添加课程视图
     * @author 晚黎
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $permissions = PermissionRepository::findPermissionWithArray();
        $roles = RoleRepository::findRoleWithObject();
        return view('admin.course.create')->with(compact(['permissions','roles']));
    }

    /**
     * 添加课程
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(CreateCourseRequest $request)
    {
        CourseRepository::store($request);
        return redirect('admin/course');
    }

    /**
     * 修改课程视图
     * @author 晚黎
     * @date   2016-04-14T15:01:16+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $course = CourseRepository::edit($id);
        return view('admin.course.edit')->with(compact('course'));
    }
    /**
     * 修改课程资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(UpdateCourseRequest $request,$id)
    {
        CourseRepository::update($request,$id);
        return redirect('admin/course');
    }

    /**
     * 修改课程状态
     * @author 晚黎
     * @date   2016-04-14T11:50:04+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark($id,$status)
    {
        CourseRepository::mark($id,$status);
        return redirect('admin/course');
    }

    /**
     * 删除课程
     * @author 晚黎
     * @date   2016-04-14T11:52:40+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        CourseRepository::destroy($id);
        return redirect('admin/course');
    }
    /**
     * 查看课程信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function show($id)
    {
        $course = CourseRepository::show($id);
        return view('admin.course.show')->with(compact('course'));
    }

}
