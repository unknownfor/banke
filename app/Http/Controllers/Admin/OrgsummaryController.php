<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\admin\OrgSummaryRepository;
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
use App\Repositories\admin\OrgTagsRepository;
use App\Models\Banke\BankeOrg;
use Illuminate\Support\Facades\Log;

class OrgsummaryController extends Controller
{
	/**
     * 机构列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.orgsummary.list');
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

        $newArr=Array();
        if(!$category1){
            $category1=$newArr;
        }
        if(!$category2){
            $category2=$newArr;
        }

        $OrgCategory=new OrgCategoryRepository();
        $OrgCategory->batchStore( array_merge($category1, $category2),$id);

        $tags= $request->tags;  //标签
        $OrgTags=new OrgTagsRepository();
        $OrgTags->batchStore($tags,$id);

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
        $trainCategory=new TrainCategoryRepository();
        $categories=$trainCategory->getAllTopCategory();  //所有顶级分类
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
    public function update(UpdateOrgRequest $request,$id)
    {
        OrgRepository::update($request,$id);

        $category1 = $request->category1;
        $category2 = $request->category2;
        $newArr=Array();
        if(!$category1){
            $category1=$newArr;
        }
        if(!$category2){
            $category2=$newArr;
        }
        $OrgCategory=new OrgCategoryRepository();
        $OrgCategory->batchStore( array_merge($category1, $category2),$id);

        $tags= $request->tags;  //标签
        $OrgTags=new OrgTagsRepository();
        $OrgTags->batchStore($tags,$id);
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
        OrgRepository::destroy($id);
        return redirect('admin/orgsummary');
    }

}
