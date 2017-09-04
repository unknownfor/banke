<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeTaskFormDetail;
use Illuminate\Support\Facades\Log;

/**
* 15天任务表仓库
*/
class TaskFormDetailRepository
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

		$taskFormDetail = new BankeTaskFormDetail;

		/*状态搜索*/
		if ($status!=null) {
			$taskFormDetail = $taskFormDetail->where('status', $status);
		}

		$count = $taskFormDetail->count();

		$taskFormDetail = $taskFormDetail->offset($start)->limit($length);
		$taskFormDetails = $taskFormDetail->orderBy("id", "desc")->get();

		if ($taskFormDetails) {
			foreach ($taskFormDetails as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
				$taskform=$v->taskform;
				$v['task_type_name']=$v->tasktype['name'];
				$v['seq_no_name']=$taskform['name'];
				$v['user_type']=$taskform['user_type'];
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $taskFormDetails,
		];
	}



	/**添加15任务
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$taskFormDetail = new BankeTaskFormDetail;
		if ($taskFormDetail->fill($request->all())->save()) {
			Flash::success(trans('alerts.taskformdetail.created_success'));
			return $taskFormDetail->id;
		}
		Flash::error(trans('alerts.taskformdetail.created_error'));
		return false;
	}

	/**添加15任务 可以点击的外链
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function storeOutlinkClick($request)
	{
		$input=$request->all();
		$taskFormDetail = new BankeTaskFormDetail;
		if ($taskFormDetail->fill($request->all())->save()) {
			Flash::success(trans('alerts.taskformdetail.created_success'));
			return $taskFormDetail->id;
		}
		Flash::error(trans('alerts.taskformdetail.created_error'));
		return false;
	}

	/**
	 * 修改15任务
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$role = BankeTaskFormDetail::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
		abort(404);
	}

	/**
	 * 查看15任务
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$taskFormDetail = BankeTaskFormDetail::find($id)->toArray();
		return $taskFormDetail;
	}

	/**
	 * 修改15任务
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeTaskFormDetail::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.taskformdetail.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.taskformdetail.updated_error'));
			return false;
		}
		abort(404);
	}


	/**
	 * 删除15任务
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeTaskFormDetail::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.taskformdetail.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.taskformdetail.deleted_error'));
		return false;
	}
}