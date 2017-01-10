<?php
namespace App\Repositories\admin;
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

		$name = request('name' ,'');
		$org_id = request('org_id' ,'');
		$price = request('price' ,'');
		$intro = request('intro' ,'');
		$status = request('status' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$user = new BankeCourse;

		/*课程名称搜索*/
		if($name){
			if($search_pattern){
				$user = $user->where('name', 'like', $name);
			}else{
				$user = $user->where('name', $name);
			}
		}

		/*价格搜索*/
		if($price){
			if($search_pattern){
				$user = $user->where('price', 'like', $price);
			}else{
				$user = $user->where('price', $price);
			}
		}
		/*简介搜索*/
		if($intro){
			if($search_pattern){
				$user = $user->where('intro', 'like', $intro);
			}else{
				$user = $user->where('intro', $intro);
			}
		}

		/*机构id搜索*/
		if($org_id){
			$user = $user->where('org_id', $intro);
		}
		
		/*状态搜索*/
		if ($status) {
			$user = $user->where('status', $status);
		}

		/*创建时间搜索*/
		if($created_at_from){
			$user = $user->where('created_at', '>=', getTime($created_at_from));	
		}
		if($created_at_to){
			$user = $user->where('created_at', '<=', getTime($created_at_to, false));	
		}

		/*修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
			$user = $user->where('created_at', '>=', getTime($updated_at_from));	
		}
		if($updated_at_to){
			$user = $user->where('created_at', '<=', getTime($updated_at_to, false));	
		}

		$count = $user->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$user = $user->orderBy($orderName, $orderDir);
		}

		$user = $user->offset($start)->limit($length);
		$users = $user->get();

		if ($users) {
			foreach ($users as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
			}
		}
		
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $users,
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

}