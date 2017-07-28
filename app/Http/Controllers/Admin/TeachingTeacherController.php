<?php
/**
* 教学控制器
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use TeachingTeacherRepository;
use OrgRepository;
use OrgSummaryRepository;
use App\Models\Banke\BankeTeachingTeacher;
use Illuminate\Http\Request;
use App\Http\Requests\TeachingTeacherRequest;
use Flash;

class TeachingTeacherController extends Controller {


    /**
     * 列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        $sub_orgs=OrgRepository::getAllSubOrgs();
        return view('admin.teachingteacher.list')->with(compact(['sub_orgs']));
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = TeachingTeacherRepository::ajaxIndex();
        return response()->json($data);
    }

    /**
     * 添加活动
     * @author 晚黎
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $orgs=OrgSummaryRepository::getAllSubOrgs();
        return view('admin.teachingteacher.create')->with(compact(['orgs']));
    }

    /**
     * 添加活动
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(TeachingTeacherRequest $request)
    {
        $teachingteacher_id = TeachingTeacherRepository::store($request);
        return redirect('admin/teachingteacher');
    }

    /**
     * 修改活动视图
     * @author 晚黎
     * @date   2016-04-14T15:01:16+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $teachingteacher = TeachingTeacherRepository::edit($id);
        $sub_orgs=OrgRepository::getOrgByPid($teachingteacher['org_id']);
        $orgs=OrgSummaryRepository::getAllSubOrgs();
        return view('admin.teachingteacher.edit')->with(compact(['teachingteacher','sub_orgs','orgs']));
    }
    /**
     * 修改活动资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(TeachingTeacherRequest $request,$id)
    {
        TeachingTeacherRepository::update($request,$id);
        return redirect('admin/teachingteacher');
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
        TeachingTeacherRepository::mark($id,$status);
        return redirect('admin/teachingteacher');
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
        TeachingTeacherRepository::destroy($id);
        return redirect('admin/teachingteacher');
    }

    /**
     * 查看活动信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function show($id)
    {
        $org = TeachingTeacherRepository::show($id);
        return view('admin.teachingteacher.show')->with(compact('org'));
    }

    private function getAllSubOrg()
    {
        $allOrg=BankeOrg::where('status',1)->get();
        return $allOrg;
    }

}
