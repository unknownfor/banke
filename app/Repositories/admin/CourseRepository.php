<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeTrainCategory;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeCourse;
use Illuminate\Support\Facades\Log;
use TrainCategoryRepository;
/**
* 课程仓库
*/
class CourseRepository
{
	/**
	 * datatable获取数据
	 * @author shaolei
	 * @date   2016-04-13T21:14:37+0800
	 * @return [type]                   [description]
	 */
	public function ajaxIndex()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.golbal.list.start')); /*获取开始*/
		$length = request('length', config('admin.golbal.list.length')); ///*获取条数*/

		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/

		$course_name = request('name' ,'');
		$org_id = request('org_id' ,'');
		$orders = request('order', []);
		$status = request('status' ,'');

		$course = new BankeCourse;
		/*课程名称搜索*/
		if($course_name){
			if($search_pattern){
				$course = $course->where('name', 'like', $course_name);
			}else{
				$course = $course->where('name', $course_name);
			}
		}
		/*状态搜索*/
		if ($status!=null) {
			$course = $course->where('status', $status);
		}

		/*机构搜索*/
		if($org_id){
			$course = $course->where('org_id',$org_id);
		}
//		else{
//				$courses=$course->where('id','-1')->get();
//				return [
//					'draw' => $draw,
//					'recordsTotal' => 0,
//					'recordsFiltered' => 0,
//					'data' => $courses
//				];
//			}
		$count = $course->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$course = $course->orderBy($orderName, $orderDir);
		}

		$course = $course->offset($start)->limit($length);
		$courses = $course->orderBy("id", "desc")->get();

		//所有的二级分类
		$trainCategpry=new TrainCategoryRepository();
		$allSecondCategory=$trainCategpry::getAllSecondCategory();

		if ($courses) {
			foreach ($courses as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
				$v['org_name'] = $v->org['name'];
				$v['category_name']='';
				$category=$v->category;
				if($category) {
					$v['category_name'] = $this->getCategoryNameById($category->cid,$allSecondCategory);
				}
			}
		}
		
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $courses,
		];
	}

	public function getCategoryNameById($id,$all){
		foreach($all as &$v){
			if($v->id==$id){
				return $v['name'];
			}
		}
		return '';
	}


	/**添加课程
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$course = new BankeCourse;
		if ($course->fill($request->all())->save()) {
			Flash::success(trans('alerts.course.created_success'));
			return $course->id;
		}
		Flash::error(trans('alerts.course.created_error'));
		return false;
	}

	/**
	 * 修改课程视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$role = BankeCourse::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
		abort(404);
	}
	/**
	 * 修改课程
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeCourse::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.course.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.course.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 修改课程状态
	 * @author shaolei
	 * @date   2016-04-13T11:51:02+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function mark($id,$status)
	{
		$role = BankeCourse::find($id);
		if ($role) {
			$role->status = $status;
			if ($role->save()) {
				Flash::success(trans('alerts.course.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.course.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除课程
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeCourse::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.course.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.course.deleted_error'));
		return false;
	}

	/**
	 * 查看课程信息
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$course = BankeCourse::find($id);
		if(!$course['cover']){
			$course['cover']='http://pic.hisihi.com/2017-05-10/1494404142666471.png';
		}
		return $course;
	}

	public function search_by_org()
	{
		$org_id = request('org_id', '');
		$course = BankeCourse::where('org_id', $org_id)->where('status', 1)->get(['id', 'name']);
		return $course;
	}


	public function getCategoryName($id)
	{
		$category = BankeCourse::find($id)->category();
		$name='';
		if($category->count()>0) {
			$course = BankeTrainCategory::find($category->first()['cid']);
			$name=$course['name'];
		}
		return $name;
	}

}