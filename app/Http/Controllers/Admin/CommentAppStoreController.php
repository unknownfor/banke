<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use CommentAppStoreRepository;
use PermissionRepository;
use RoleRepository;
use TrainCategoryRepository;
use Illuminate\Support\Facades\Log;
use App\Models\Banke\BankeAppStore;

class CommentAppStoreController extends Controller
{

    public function index(){
        return view('admin.commentappstore.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = CommentAppStoreRepository::ajaxIndex();
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
        $commentappstore = CommentAppStoreRepository::edit($id);
        CommentAppStoreRepository::updateReadStatus($id);  //修改阅读状态
        return view('admin.commentappstore.edit')->with(compact('commentappstore'));
    }
    /**
     * 修改机构资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(CommentAppStoreRequest $request,$id)
    {
        CommentAppStoreRepository::updateComment($request, $id);
        return redirect('admin/commentappstore');
    }

    /**
     * 修改认证状态
     * @author shaolei
     * @date   2016-04-14T11:50:04+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function certificate($id,$status)
    {
        CommentAppStoreRepository::certificate($id,$status);
        return redirect('admin/commentappstore');
    }
}
