<?php
/**
* 活动控制器
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use TeachingTeacherRepository;
use App\Models\Banke\BankeOrg;
use Illuminate\Http\Request;
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
        $sub_orgs=$this->getAllOrg();
        return view('admin.teachingteacher.list')->with(compact(['sub_org']));
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = ActivityRepository::ajaxIndex();
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
        $cities=BankeBusinessCity::where('status',1)->orderBy('sort')->get(['name']);
        $allcourse=$this->getAllCourse();
        return view('admin.teachingteacher.create')->with(compact(['cities','allcourse']));
    }

    /**
     * 添加活动
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(ActivityRequest $request)
    {
        $teachingteacher_id = ActivityRepository::store($request);
        $this->updateJoinInCourse($teachingteacher_id,$request);
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
        $cities=BankeBusinessCity::where('status',1)->orderBy('sort')->get(['name']);
        $teachingteacher = ActivityRepository::edit($id);
        $repository=new ActivityCourseRepository();
        $course_arr=$repository->getAllCouseIdArrByActivityId($id);
        $teachingteacher['course_arr']=$course_arr;
        $teachingteacher['course']=implode(',',$course_arr);
        $allcourse=$this->getAllCourse();
        return view('admin.teachingteacher.edit')->with(compact(['teachingteacher','cities','allcourse']));
    }
    /**
     * 修改活动资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(ActivityRequest $request,$id)
    {
        ActivityRepository::update($request,$id);
        $this->updateJoinInCourse($id,$request);
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
        ActivityRepository::mark($id,$status);
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
        ActivityRepository::destroy($id);
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
        $org = ActivityRepository::show($id);
        return view('admin.teachingteacher.show')->with(compact('org'));
    }

    private function getAllOrg()
    {
        $allOrg=BankeOrg::where('status',1)->get();
        return $allOrg;
    }

}
