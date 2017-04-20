<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use OrgRepository;
use App\Http\Requests\CreateOrgRequest;
use App\Http\Requests\UpdateOrgRequest;
use PermissionRepository;
use RoleRepository;
use TrainCategoryRepository;
use App\Repositories\admin\OrgCategoryRepository;
use App\Repositories\admin\OrgTagsReporsitory;
use App\Models\Banke\BankeOrg;
use Illuminate\Support\Facades\Log;

class OrgController extends Controller
{
	/**
     * 机构列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.org.list');
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = OrgRepository::ajaxIndex();
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
        return view('admin.org.create')->with(compact(['permissions','roles','allCategories']));
    }

    /**
     * 添加机构
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(CreateOrgRequest $request)
    {
        $id = OrgRepository::store($request);
        $category1 = $request->category1;
        $category2 = $request->category2;
        $OrgCategory=new OrgCategoryRepository();
        $OrgCategory->batchStore( array_merge($category1, $category2),$id);

        $tags= $request->tags;  //标签
        $OrgTags=new OrgTagsReporsitory();
        $OrgTags->batchStore($tags,$id);

        return redirect('admin/org');
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
        $org = OrgRepository::edit($id);
        $category1=TrainCategoryRepository::getAllTopCategory();
        $categoryIds=OrgRepository::getTrainCategoryIds($id);
        $category2=OrgRepository::getCategory2Info($id);
        $tags=OrgRepository::getTags($id);
        $org['tags']=$tags;
        return view('admin.org.edit')->with(compact('org','allCategories','category1','category2','categoryIds'));
    }
    /**
     * 修改机构资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(UpdateOrgRequest $request,$id)
    {
        OrgRepository::update($request,$id);

        $category1 = $request->category1;
        $category2 = $request->category2;
        $OrgCategory=new OrgCategoryRepository();
        $OrgCategory->batchStore( array_merge($category1, $category2),$id);

        $tags= $request->tags;  //标签
        $OrgTags=new OrgTagsReporsitory();
        $OrgTags->batchStore($tags,$id);
        return redirect('admin/org');
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

    /**
     * 查看机构信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function show($id)
    {
        $org = BankeOrg::find($id);
//        $categories=OrgRepository::getCategoryInfo($id);
        $category1=OrgRepository::getCategory1Info($id);
//        $categoryIds=OrgRepository::getTrainCategoryIds($id);
        $category2=OrgRepository::getCategory2Info($id);
        return view('admin.org.show')->with(compact('org','category1','category2'));
    }

    public function share_org_v1_2($id){
        $org = BankeOrg::find($id);
        return view('web.org.org')->with(compact(['org']));
    }

    /**
     * 机构评论列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function comments()
    {
        return view('admin.org.comment-list');
    }

}
