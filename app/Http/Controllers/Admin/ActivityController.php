<?php
/**
* 活动控制器
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use ActivityRepository;
use App\Models\Banke\BankeCourse;
use Illuminate\Http\Request;
use App\Http\Requests\ActivityRequest;
use App\Http\Requests\ActivityOutlinkClickRequest;
use BusinessCityRepository;
use App\Repositories\admin\ActivityCourseRepository;
use Flash;

class ActivityController extends Controller {


    /**
     * 列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.activity.list');
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
        $cities=BusinessCityRepository::getAllBusinessCity();
        $allcourse=$this->getAllCourse();
        return view('admin.activity.create')->with(compact(['cities','allcourse']));
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
        $activity_id = ActivityRepository::store($request);
        $this->updateJoinInCourse($activity_id,$request);
        return redirect('admin/activity');
    }
    /**
     * 添加活动 可点击外链
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store_outlink_click(ActivityOutlinkClickRequest $request)
    {
        $activity_id = ActivityRepository::storeOutlinkClick($request);
        $this->updateJoinInCourse($activity_id,$request);
        return redirect('admin/activity');
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
        $cities=BusinessCityRepository::getAllBusinessCity();
        $activity = ActivityRepository::edit($id);

        $repository=new ActivityCourseRepository();
        $course_arr=$repository->getAllCouseIdArrByActivityId($id);
        $activity['course_arr']=$course_arr;
        $activity['course']=implode(',',$course_arr);
        $allcourse=$this->getAllCourse();
        if($activity['url_type']==1){
            if($activity['out_url_type']==1){
                return view('admin.activity.edit-outclick')->with(compact(['activity','cities','allcourse']));
            }else{
                return view('admin.activity.edit')->with(compact(['activity','cities','allcourse']));
            }
        }
        return view('admin.activity.edit-inlink')->with(compact(['activity','cities','allcourse']));
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
        return redirect('admin/activity');
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
        return redirect('admin/activity');
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
        return redirect('admin/activity');
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
        return view('admin.activity.show')->with(compact('org'));
    }

    private function getAllCourse()
    {
        $allcourse=BankeCourse::where('status',1)->get();
        foreach($allcourse as $v){
            $v['org']=$v->org;
        }
        return $allcourse;
    }

    private function updateJoinInCourse($activity_id,$request)
    {
        $input = $request->all();
        $course=$input['course'];
        $course_arr = explode(",",$course);
        if(Count($course_arr)>0){
            $repository=new ActivityCourseRepository();
            $repository->storeMultiple($activity_id,$course_arr);
        }
    }
}
