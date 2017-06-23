<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Http\Requests\CreateOrgSummaryRequest;
use App\Http\Requests\UpdateOrgRequest;
use PermissionRepository;
use RoleRepository;
use OrgSummaryRepository;
use TrainCategoryRepository;
use App\Repositories\admin\OrgCategoryRepository;
use App\Repositories\admin\OrgTagsRepository;
use App\Models\Banke\BankeOrg;
use Illuminate\Support\Facades\Log;

class OrgSummaryController extends Controller
{
	/**
     * 机构列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        $allTopCategories=TrainCategoryRepository::getAllTopCategory();
        return view('admin.orgsummary.list')->with(compact(['allTopCategories']));
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = OrgSummaryRepository::ajaxIndex();
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
        $allCategories=TrainCategoryRepository::getAllTopCategory();
        return view('admin.orgsummary.create')->with(compact(['permissions','roles','allCategories']));
    }

    /**
     * 添加机构
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(CreateOrgSummaryRequest $request)
    {
        $id = OrgSummaryRepository::store($request);
        return redirect('admin/orgsummary');
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
        $orgsummary = OrgSummaryRepository::edit($id);
        $categories=TrainCategoryRepository::getAllTopCategory();  //所有顶级分类
        return view('admin.orgsummary.edit')->with(compact('orgsummary','categories'));
    }
    /**
     * 修改机构资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(CreateOrgSummaryRequest $request,$id)
    {
        OrgSummaryRepository::update($request,$id);
        return redirect('admin/orgsummary');
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
        return redirect('admin/orgsummary');
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
        OrgSummaryRepository::destroy($id);
        return redirect('admin/orgsummary');
    }

    /**
     * 添加机构
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function branchlist($id)
    {
        $currentOrgSummaryId=$id;
        $summary_orgs=OrgSummaryRepository::getOrgs(100000000);  //所有顶级分类
        return view('admin.org.list')->with(compact(['currentOrgSummaryId','summary_orgs']));
    }

}
