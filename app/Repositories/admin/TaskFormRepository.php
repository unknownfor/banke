<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeTaskForm;
use Illuminate\Support\Facades\Log;

/**
* 任务期数仓库
*/
class TaskFormRepository
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
		$start = request('start', config('admin.global.list.start')); /*获取开始*/
		$length = request('length', config('admin.global.list.length')); ///*获取条数*/

		$status = request('status' ,'');

		$taskform = new BankeTaskForm;

		/*状态搜索*/
		if ($status!=null) {
			$taskform = $taskform->where('status', $status);
		}

		$count = $taskform->count();

		$taskform = $taskform->offset($start)->limit($length);
		$taskforms = $taskform->orderBy("id", "desc")->get();

		if ($taskforms) {
			foreach ($taskforms as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $taskforms,
		];
	}



	/**添加任务
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$input=$request->all();
		$taskform = new BankeTaskForm;
		if ($taskform->fill($input)->save()) {
			Flash::success(trans('alerts.taskform.created_success'));
			return $taskform->id;
		}
		Flash::error(trans('alerts.taskform.created_error'));
		return false;
	}

	/**
	 * 修改任务
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$role = BankeTaskForm::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
		abort(404);
	}

	/**
	 * 查看任务
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$taskform = BankeTaskForm::find($id)->toArray();
		return $taskform;
	}

	/**
	 * 修改任务
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeTaskForm::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.taskform.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.taskform.updated_error'));
			return false;
		}
		abort(404);
	}


	/**
	 * 删除任务
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeTaskForm::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.taskform.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.taskform.deleted_error'));
		return false;
	}
}