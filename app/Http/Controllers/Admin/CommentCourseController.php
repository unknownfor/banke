<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use CommentCourseRepository;
use App\Http\Requests\CommentCourseRequest;
use PermissionRepository;
use RoleRepository;
use TrainCategoryRepository;
use Illuminate\Support\Facades\Log;
use App\Models\Banke\BankeCourse;

class CommentCourseController extends Controller
{

    public function index(){
        $allCourse=BankeCourse::where('status',1)->get(['id','name']);
        return view('admin.commentcourse.all')->with(compact('allCourse'));
    }

	/**
     * 课程评论列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function show($id)
    {
        $cid=$id;
        $name=BankeCourse::find($id)['name'];
        return view('admin.commentcourse.list')->with(compact('cid','name'));
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = CommentCourseRepository::ajaxIndex();
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
        $commentcourse = CommentCourseRepository::edit($id);
        CommentCourseRepository::updateReadStatus($id);  //修改阅读状态
        return view('admin.commentcourse.edit')->with(compact('commentcourse'));
    }
    /**
     * 修改机构资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(CommentCourseRequest $request,$id)
    {
        CommentCourseRepository::updateComment($request, $id);
        return redirect('admin/commentcourse');
    }
}
