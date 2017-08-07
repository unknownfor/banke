<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeDailyTaskLog;
use Illuminate\Support\Facades\Log;

/**
* 每日任务仓库
*/
class DailyTaskLogRepository
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

		$activity = new BankeActivity;

		/*状态搜索*/
		if ($status!=null) {
			$activity = $activity->where('status', $status);
		}

		$count = $activity->count();

		$activity = $activity->offset($start)->limit($length);
		$activitys = $activity->orderBy("sort","desc")->orderBy("id", "desc")->get();

		if ($activitys) {
			foreach ($activitys as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $activitys,
		];
	}



	/**添加活动
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$dailyTaskLog = new BankeDailyTaskLog;
		if ($dailyTaskLog->fill($request->all())->save()) {
			Flash::success(trans('alerts.activity.created_success'));
			return $dailyTaskLog->id;
		}
		Flash::error(trans('alerts.activity.created_error'));
		return false;
	}

	/**
	 * 修改活动
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$role = BankeActivity::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
		abort(404);
	}

	/**
	 * 查看活动
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$activity = BankeActivity::find($id)->toArray();
		return $activity;
	}

	/**
	 * 修改活动
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeActivity::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.activity.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.activity.updated_error'));
			return false;
		}
		abort(404);
	}


	/**
	 * 删除活动
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeActivity::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.activity.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.activity.deleted_error'));
		return false;
	}
}