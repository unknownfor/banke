<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeTask;
use Illuminate\Support\Facades\Log;

/**
* 任务仓库
*/
class TaskRepository
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

		$task = new BankeTask;

		/*状态搜索*/
		if ($status!=null) {
			$task = $task->where('status', $status);
		}

		$count = $task->count();

		$task = $task->offset($start)->limit($length);
		$tasks = $task->orderBy("id", "desc")->get();

		if ($tasks) {
			foreach ($tasks as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $tasks,
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
		$tempTask=BankeTask::orderBy('id', 'desc');
		$maxNum=1;
		if($tempTask->count()>0){
			$tempTask=$tempTask->first();
			$maxNum=$tempTask['type']+1;
		}
		$input['type']=$maxNum;
		$task = new BankeTask;
		if ($task->fill($input)->save()) {
			Flash::success(trans('alerts.task.created_success'));
			return $task->id;
		}
		Flash::error(trans('alerts.task.created_error'));
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
		$role = BankeTask::find($id);
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
		$task = BankeTask::find($id)->toArray();
		return $task;
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
		$role = BankeTask::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.task.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.task.updated_error'));
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
		$isDelete = BankeTask::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.task.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.task.deleted_error'));
		return false;
	}
}