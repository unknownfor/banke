<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeDailyTaskLog;
use App\Models\Banke\BankeUserProfiles;
use App\Models\Banke\BankeDict;
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



	/**添加每日任务记录信息
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($input)
	{
		$dailyTaskLog = new BankeDailyTaskLog;
		if ($dailyTaskLog->fill($input->all())->save()) {
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

	/**
	 * 将记录添加、更新到 banke_daily_task_log 表中
	 * @author jimmy
	 * @date   2017-08-04T11:42:19+0800
	 * @param  [int]  $invitor_id  [邀请人id]
	 * @return [int]  $task_type [任务类型 0：开团招生；1:邀请好友成为大使；2：分享半课；3：邀请好友注册]
	 */
	public static function updateBankeDailyTaskLog($invitor_id,$task_type)
	{
		$user=BankeUserProfiles::find($invitor_id);
		$mobile=$user['mobile'];
		$award_flag=false;

		// 奖励邀请人，如果今天已经审核通过次数，达到了上限，不给奖励
		$dailyTask=BankeDailyTaskLog::where(['uid'=>$invitor_id,'task_type'=>$task_type]);
		$count=$dailyTask->count();
		if($count>0){
			$dic=BankeDict::whereIn('id',array(21,23))->get(['value'])->toArray();
			$systemLimitCounts=$dic[0]['value'];
			$switch=$dic[1]['value'];

			$dailyTask=$dailyTask->first();
			$todayCounts=$dailyTask['today_counts'];

			//总次数更新
			$dailyTask->total_counts++;

			//奖励邀请人,并更新今天次数、
			if($switch==1) {
				if ($todayCounts < $systemLimitCounts) {
					$award_flag=true;
					$dailyTask->today_counts++;
				}
			}else{
				$award_flag=true;
			}
			$dailyTask->save();
		}
		else{
			//记录到 banke_daily_task_log 表中
			if($mobile) {
				$award_flag=true;
				$request = [
					'uid' => $invitor_id,
					'mobile'=>$mobile,
					'total_counts'=>1,
					'today_counts'=>1,
					'task_type'=>$task_type,
					'status'=>1,
				];
				$dailyTaskLog = new BankeDailyTaskLog;
				$dailyTaskLog->fill($request)->save();
			}
		}
		return $award_flag;
	}

}