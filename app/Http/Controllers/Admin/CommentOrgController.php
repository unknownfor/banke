<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use CommentOrgRepository;
use App\Http\Requests\CommentOrgRequest;
use PermissionRepository;
use RoleRepository;
use TrainCategoryRepository;
use App\Repositories\admin\OrgCategoryRepository;
use App\Repositories\admin\OrgTagsReporsitory;
use Illuminate\Support\Facades\Log;
use App\Models\Banke\BankeOrg;

class CommentOrgController extends Controller
{


    public function index(){
        return view('admin.commentorg.all');
    }

	/**
     * 机构评论列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function show($id)
    {
        $oid=$id;
        $name=BankeOrg::find($id)['name'];
        return view('admin.commentorg.list')->with(compact('oid','name'));
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = CommentOrgRepository::ajaxIndex();
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
        $commentorg = CommentOrgRepository::edit($id);
        CommentOrgRepository::updateReadStatus($id);  //修改阅读状态
        return view('admin.commentorg.edit')->with(compact('commentorg'));
    }
    /**
     * 修改机构资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(CommentOrgRequest $request,$id)
    {
        $oid = CommentOrgRepository::updateComment($request,$id);
        return redirect('admin/commentorg/'.$oid);
    }

    /**
     * 修改用户状态
     * @author 晚黎
     * @date   2016-04-14T11:50:04+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark($id,$status)
    {
        UserRepository::mark($id,$status);
        return redirect('admin/org');
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
        OrgRepository::destroy($id);
        return redirect('admin/org');
    }
}
