<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeDict;
use App\Models\Banke\BankeUserProfiles;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeMarketingAmbassador;
use App\Models\Banke\BankeDailyTaskLog;
use AppUserRepository;
use DailyTaskLogRepository;
use Illuminate\Support\Facades\Log;

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
	 * 修改活动
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$input = $request->only(['status']);  //只更新夜夜认证状态
		$marktingAmbassador = BankeMarketingAmbassador::find($id);
		if ($marktingAmbassador) {
			if ($marktingAmbassador['status'] == config('admin.global.status.active')) {
				Flash::error(trans('alerts.common.already_active'));
				return false;
			}
			else {

				DB::transaction(function () use ($input, $marktingAmbassador) {
					try {
						$cur_user = Auth::user();
						$input['operator_id']=$cur_user->id;
							if ($marktingAmbassador->fill($input->all())->save()) {

								//奖励邀请人。通过认证后，给推荐人奖励，并且将记录添加到 banke_daily_task_log 表中
								if ($input['status'] == config('admin.global.status.active')) {
									$this->updateBankeDailyTaskLog($marktingAmbassador['invitor_id']);
								}
								Flash::success(trans('alerts.marketingambassador.updated_success'));
								DB::commit();
								Flash::success(trans('alerts.marketingambassador.updated_success'));
								return true;
						}
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
	private function award_invitor($invitor_id)
	{
		$award=BankeDict::find(22)->value;
		AppUserRepository::execUpdateUserAccountInfo($invitor_id,$award,1,7);
		//记录到 banke_daily_task_log 表中
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
		// 奖励邀请人，如果今天已经审核通过次数，达到了上限，不给奖励
		$dailyTask=BankeDailyTaskLog::where(['uid'=>$invitor_id,'task_type'=>1]);
		$count=$dailyTask->count();
		if($count>0){
			$dic=BankeDict::whereIn('id',[21,23])->get('value')->toArray();
			$systemLimitCounts=$dic[0];
			$switch=$dic[1];
			$award_flag=false;

			$todayCounts=$dailyTask['today_count'];

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
				$this->award_invitor($invitor_id);
			}
			$dailyTask->save();
		}else{
			//记录到 banke_daily_task_log 表中
			$user=BankeUserProfiles::find($invitor_id);
			$mobile=$user['mobile'];
			if($mobile) {
				$request = [
					'uid' => $invitor_id,
					'mobile'=>$mobile,
					'total_counts'=>0,
					'today_counts'=>0,
					'task_type'=>1,
					'status'=>1,
				];
				DailyTaskLogRepository::store($request);
				$this->award_invitor($invitor_id);
			}
		}
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