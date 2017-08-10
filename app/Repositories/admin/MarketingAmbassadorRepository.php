<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeDict;
use App\Models\Banke\BankeUserProfiles;
use App\Models\Banke\BankeMessage;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeMarketingAmbassador;
use App\Models\Banke\BankeDailyTaskLog;
use AppUserRepository;
use DailyTaskLogRepository;
use Illuminate\Support\Facades\Log;
use DB;
use Auth;

/**
* 推广大全大使
*/
class MarketingAmbassadorRepository
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
		$mobile = request('mobile' ,'');

		$marketingAmbassador = new BankeMarketingAmbassador;

		/*状态搜索*/
		if ($status!=null) {
			$marketingAmbassador = $marketingAmbassador->where('status', $status);
		}

		/*手机号搜索*/
		if ($mobile!=null) {
			$marketingAmbassador = $marketingAmbassador->where('mobile','like','%'.$mobile.'%');
		}

		$count = $marketingAmbassador->count();

		$marketingAmbassador = $marketingAmbassador->offset($start)->limit($length);
		$marketingAmbassadors = $marketingAmbassador->orderBy("id", "desc")->get();

		if ($marketingAmbassadors) {
			foreach ($marketingAmbassadors as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
				$v['invitor_mobile']=$v->invitorSimple['mobile'];
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $marketingAmbassadors,
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
		$marketingAmbassador = new BankeMarketingAmbassador;
		if ($marketingAmbassador->fill($request->all())->save()) {
			Flash::success(trans('alerts.marketingambassador.created_success'));
			return $marketingAmbassador->id;
		}
		Flash::error(trans('alerts.marketingambassador.created_error'));
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
		$marktingAmbassador = BankeMarketingAmbassador::find($id);
		if ($marktingAmbassador) {
			$marktingAmbassadorArray = $marktingAmbassador->toArray();
			return $marktingAmbassadorArray;
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
		$marketingAmbassador = BankeMarketingAmbassador::find($id)->toArray();
		return $marketingAmbassador;
	}

	/**
	 * 修改推广大使状态
	 * @author jimmy
	 * @date   2016-04-13T11:51:02+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function certificate($id,$status)
	{
		$this->update($status,$id);
	}

	/**
	 * 修改推广大使
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($status,$id)
	{
		$marktingAmbassador = BankeMarketingAmbassador::find($id);
		if ($marktingAmbassador) {
			if ($marktingAmbassador['certification_status'] == config('admin.global.status.active')) {
				Flash::error(trans('alerts.common.already_active'));
				return false;
			}
			else {
				DB::transaction(function () use ($status, $marktingAmbassador) {
					try {
						$cur_user = Auth::user();
						$marktingAmbassador->operator_id=$cur_user->id;
						$marktingAmbassador->certification_status=$status;

						//奖励邀请人。通过认证后，给推荐人奖励，并且将记录添加到 banke_daily_task_log 表中
						if ($status == config('admin.global.status.active')) {

							$invitor_id=$marktingAmbassador['invitor_id'];

							//更新每日任务信息，并对每天是否能奖励做过滤
							$award_flag = DailyTaskLogRepository::updateBankeDailyTaskLog($invitor_id,1);

							if($award_flag) {
								$award = BankeDict::find(22)->value;
								$marktingAmbassador->award_amount = $award;

								$mobile=$marktingAmbassador->invitorSimple['mobile'];
								$this->award_invitor($invitor_id,$mobile,$award);//奖励用户
							}
						}
						$marktingAmbassador->save();
						DB::commit();
						Flash::success(trans('alerts.marketingambassador.updated_success'));
						return true;

					}
					catch (Exception $e) {
						DB::rollback();
						Log::info($e);
						Flash::error(trans('alerts.marketingambassador.updated_error'));
						return false;
					}
				});
			}
		}
		else{
			abort(404);
		}
	}

	/**
	 * 奖励邀请人
	 * 通过认证后，给推荐人奖励，并且将记录添加到 banke_daily_task_log 表中
	 * @author jimmy
	 * @date   2017-08-04T11:42:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	private function award_invitor($invitor_id,$mobile,$award)
	{
		AppUserRepository::execUpdateUserAccountInfo($invitor_id,$award,1,7);

		//奖励信息添加添加到message表中
		$message = [
			'uid' => $invitor_id,
			'title' => '您的好友成功认证为推广大使',
			'content' => '您邀请的好友 ' . $mobile . ' 成功认证为推广大使,平台奖励您' . $award . '元现金，快去现金钱包里查看吧！',
			'type' => config('admin.global.balance_log')[14]['key']
		];
		//记录消息
		BankeMessage::create($message);
	}

	/**
	 * 将记录添加、更新到 banke_daily_task_log 表中
	 * @author jimmy
	 * @date   2017-08-04T11:42:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	private function updateBankeDailyTaskLog($invitor_id)
	{
		$user=BankeUserProfiles::find($invitor_id);
		$mobile=$user['mobile'];
		$award_flag=false;

		// 奖励邀请人，如果今天已经审核通过次数，达到了上限，不给奖励
		$dailyTask=BankeDailyTaskLog::where(['uid'=>$invitor_id,'task_type'=>1]);
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

			if($award_flag){
				$this->award_invitor($invitor_id,$mobile);
			}
			$dailyTask->save();
		}
		else{
			//记录到 banke_daily_task_log 表中
			$award_flag=true;
			if($mobile) {
				$request = [
					'uid' => $invitor_id,
					'mobile'=>$mobile,
					'total_counts'=>1,
					'today_counts'=>1,
					'task_type'=>1,
					'status'=>1,
				];
				DailyTaskLogRepository::store($request);
				$this->award_invitor($invitor_id,$mobile);
			}
		}
		return $award_flag;
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
		$isDelete = BankeMarketingAmbassador::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.marketingambassador.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.marketingambassador.deleted_error'));
		return false;
	}
}