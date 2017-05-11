<?php

namespace App\Http\Controllers\Admin;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeDict;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use CourseRepository;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use PermissionRepository;
use RoleRepository;
use Illuminate\Support\Facades\Log;
use TrainCategoryRepository;
use OrgRepository;
use App\Repositories\admin\CourseCategoryRepository;

class CourseController extends Controller
{
	/**
     * 课程列表
     * @author jimmy
     * @date   2016-12-27
     * @return [type]                   [description]
     */
    public function index()
    {
        $orgs = BankeOrg::where('status', 1)->get(['id', 'name']);
        return view('admin.course.list')->with(compact('orgs'));
    }

    /**
     * datatable 获取数据
     * @author 晚黎
     * @date   2016-04-13T11:25:58+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $data = CourseRepository::ajaxIndex();
        return response()->json($data);
    }
    /**
     * 添加课程视图
     * @author 晚黎
     * @date   2016-04-13T11:26:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $org = new BankeOrg;
        $orgs = $org->where('status', 1)->orderBy('sort', 'desc')->get(['id', 'name']);
        $percent=$this->getDict();
        return view('admin.course.create')->with(compact(['orgs','percent']));
    }

    /**
     * 添加课程
     * @author 晚黎
     * @date   2016-04-14T11:31:29+0800
     * @param  CreateUserRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(CreateCourseRequest $request)
    {
        $percent=$this->getDict();
        if($request['checkin_award']==''){
            $request['checkin_award']=$percent[0]['value'];
        }
        if($request['task_award']==''){
            $request['task_award']=$percent[1]['value'];
        }
//        如果没有手动设置转介绍金额奖励则调用系统分配
        if($request['z_award_amount']==''){
            $request['z_award_amount']=$percent[2]['value'];
        }
        $id = CourseRepository::store($request);

        $courseCategoryRepository = new CourseCategoryRepository();
        if($request['category_id']){
            $courseCategoryRepository->update($request['category_id'],$id);
        }
        return redirect('admin/course');
    }

    /**
     * 修改课程视图
     * @author 晚黎
     * @date   2016-04-14T15:01:16+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $org = new BankeOrg;
        $orgs = $org->where('status', 1)->orderBy('sort', 'desc')->get(['id', 'name']);
        $course = BankeCourse::find($id);
        $percent=$this->getDict();
        $allCategories=OrgRepository::getCategory2Info($course['org_id']);
        return view('admin.course.edit')->with(compact(['course', 'orgs','percent','allCategories']));
    }
    /**
     * 修改课程资料
     * @author 晚黎
     * @date   2016-04-14T15:16:54+0800
     * @param  UpdateUserRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(UpdateCourseRequest $request,$id)
    {   
        $percent=$this->getDict();
        if($request['checkin_award']==''){
            $request['checkin_award']=$percent[0]['value'];
        }
        if($request['task_award']==''){
            $request['task_award']=$percent[1]['value'];
        }
//        如果没有手动设置转介绍金额奖励则调用系统分配
        if($request['z_award_amount']==''){
            $request['z_award_amount']=$percent[2]['value'];
        }
        CourseRepository::update($request,$id);

        $courseCategoryRepository = new CourseCategoryRepository();
        if($request['category_id']){
            $courseCategoryRepository->update($request['category_id'],$id);
        }
        return redirect('admin/course');
    }

    /**
     * 修改课程状态
     * @author 晚黎
     * @date   2016-04-14T11:50:04+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark($id,$status)
    {
        CourseRepository::mark($id,$status);
        return redirect('admin/course');
    }

    /**
     * 删除课程
     * @author 晚黎
     * @date   2016-04-14T11:52:40+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        CourseRepository::destroy($id);
        return redirect('admin/course');
    }
    /**
     * 查看课程信息
     * @author 晚黎
     * @date   2016-04-14T13:49:32+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function show($id)
    {
        $orgs=BankeOrg::where('status',1)->orderBy('sort', 'desc')->get(['id','name']);
        $course = CourseRepository::show($id);
        $percent=$this->getDict();
        $course['category_name']=CourseRepository::getCategoryName($id);
        return view('admin.course.show')->with(compact(['course','orgs','percent']));
    }

    public function  getDict(){
        $percent = new BankeDict;
        $percent = $percent->whereIn('id', [3, 4, 7])->get();
        return $percent;
    }

    public function search_by_org()
    {
        $data = CourseRepository::search_by_org();
        return response()->json($data);
    }


    //根据机构id 获得可选的分类
    public function getSecondCategoryByOrg()
    {
        $org_id = request('org_id', '');
        $data = OrgRepository::getCategory2Info($org_id);
        return response()->json($data);
    }

}
