<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use FeedbackRepository;
use PermissionRepository;
use RoleRepository;

use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
	/**
     * 反馈列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.feedback.list');
    }

    /**
     * datatable 获取反馈数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = FeedbackRepository::ajaxIndex();
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

        FeedbackRepository::destroy($id);
        return redirect('admin/feedback');

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
        Log::info('-----------------------ab--------------------');
        $feedback = FeedbackRepository::show($id);
        return view('admin.feedback.show')->with(compact('feedback'));

    }
}
