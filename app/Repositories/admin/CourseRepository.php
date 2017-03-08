<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeOrg;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeCourse;
use Illuminate\Support\Facades\Log;
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
		$org_name = request('org_name' ,'');
		$orders = request('order', []);
		$status = request('status' ,'');

		$course = new BankeCourse;
		$org = new BankeOrg;
		Log::info('-------------------------哈哈谷侃侃保人');
		/*课程名称搜索*/
		if($course_name){
			Log::info('-------------------------'+$course_name);
			if($search_pattern){
				$course = $course->where('name', 'like', $course_name);
			}else{
				Log::info('--------------------131313-----'+$course_name);
				$course = $course->where('name', $course_name);
			}
		}
		/*状态搜索*/
		if ($status!=null) {
			$course = $course->where('status', $status);
		}

		/*机构搜索*/
		if($org_name){
			$tempOrg = $org->where('name', $org_name);
			if($tempOrg && $tempOrg->count()>0) {
				$tempOrg = $tempOrg->first();
				$course = $course->where('org_id', $tempOrg['id']);
			}else{
				$courses=$course->where('id','-1')->get();
				return [
					'draw' => $draw,
					'recordsTotal' => 0,
					'recordsFiltered' => 0,
					'data' => $courses
				];
			}
		}

		$count = $course->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$course = $course->orderBy($orderName, $orderDir);
		}

		$course = $course->offset($start)->limit($length);
		$courses = $course->get();

		if ($courses) {
			foreach ($courses as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
				$that_org = $org->find($v['org_id']);
				$v['org_name'] = $that_org['name'];
			}
		}
		
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $courses,
		];
	}


	/**添加课程
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$role = new BankeCourse;
		if ($role->fill($request->all())->save()) {
			Flash::success(trans('alerts.course.created_success'));
			return true;
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
		$course = BankeCourse::find($id)->toArray();
		return $course;
	}

	public function search_by_org()
	{
		$org_id = request('org_id', '');
		$course = BankeCourse::where('org_id', $org_id)->where('status', 1)->get(['id', 'name']);
		return $course;
	}
}