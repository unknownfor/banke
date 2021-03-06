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
        $summary_orgs=OrgSummaryRepository::getOrgs(100000000);  //所有顶级分类
        $currentOrgSummaryId=0;
        return view('admin.org.list')->with(compact(['summary_orgs','currentOrgSummaryId']));
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

        $summary_orgs=OrgSummaryRepository::getOrgs(100000000);  //所有顶级分类

        return view('admin.org.create')->with(compact(['permissions','roles','allCategories','summary_orgs']));
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
        $all = $request->all();
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

        $orgCategory=new OrgCategoryRepository();
        $orgCategory->batchStore( array_merge($category1, $category2),$id);

        $tags= $request->tags;  //标签
        $orgTags=new OrgTagsRepository();
        $orgTags->batchStore($tags,$id);

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
        $category1=OrgRepository::getCategory1Info($id);  //所有顶级分类
        $category2=OrgRepository::getCategory2Info($id); //我的二级分类
        $tags=OrgRepository::getTags($id);
        $org['tags']=$tags;
        $org['category1']=$category1;
        $org['category2']=$category2;

        $summary_orgs=OrgSummaryRepository::getOrgs(100000000);  //所有顶级分类

        return view('admin.org.edit')->with(compact('org','summary_orgs'));
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
        $category1=OrgRepository::getCategory1InfoRead($id);
        $category2=OrgRepository::getCategory2InfoRead($id);
        $summary_orgs=OrgSummaryRepository::getOrgs(100000000);  //所有顶级分类
        return view('admin.org.show')->with(compact('org','category1','category2','summary_orgs'));
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

    //根据机构id 获得机构评论分享比例
    public function getCommentSharePercent()
    {
        $org_id = request('org_id', '');
        $data = OrgRepository::getCommentSharePercent($org_id);
        return response()->json($data);
    }

    //根据父机构id 获得机构
    public function getOrgByPid($pid)
    {
        $data = OrgRepository::getOrgByPid($pid);
        return response()->json($data);
    }

    /*地图页面*/
    public function mapPage()
    {
        return view('admin.org.map');
    }

}
