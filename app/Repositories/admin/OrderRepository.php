<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeBalanceLog;
use App\Models\Banke\BankeCashBackUser;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeDict;
use App\Models\Banke\BankeMessage;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeUserProfiles;
use Carbon\Carbon;
use Flash;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;

/**
* 权限仓库
*/
class OrderRepository
{
	/**
	 * datatable获取数据
	 * @author shaolei
	 * @date   2016-12-26T11:49:03+0800
	 * @return [type]                   [description]
	 */
	public function ajaxIndex()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.global.list.start')); /*获取开始*/
		$length = request('length', config('admin.global.list.length')); ///*获取条数*/

//		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/
		$search_pattern = true;

		$name = request('name' ,'');
		$mobile = request('mobile' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$role = new BankeCashBackUser;

		/*配置名称搜索*/
		if($name){
			if($search_pattern){
				$role = $role->where('name', 'like', $name);
			}else{
				$role = $role->where('name', $name);
			}
		}

		/*配置名称搜索*/
		if($mobile){
			if($search_pattern){
				$role = $role->where('mobile', 'like', $mobile);
			}else{
				$role = $role->where('mobile', $mobile);
			}
		}

		/*配置创建时间搜索*/
		if($created_at_from){
			$role = $role->where('created_at', '>=', getTime($created_at_from));	
		}
		if($created_at_to){
			$role = $role->where('created_at', '<=', getTime($created_at_to, false));	
		}

		/*配置修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
			$role = $role->where('created_at', '>=', getTime($updated_at_from));	
		}
		if($updated_at_to){
			$role = $role->where('created_at', '<=', getTime($updated_at_to, false));	
		}

		$count = $role->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$role = $role->orderBy($orderName, $orderDir);
		}

		$role = $role->offset($start)->limit($length);
		$roles = $role->get();

		if ($roles) {
			foreach ($roles as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $roles,
		];
	}

	/**
	 * datatable获取数据
	 * @author shaolei
	 * @date   2016-12-26T11:49:03+0800
	 * @return [type]                   [description]
	 */
	public function ajaxCheck()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.global.list.start')); /*获取开始*/
		$length = request('length', config('admin.global.list.length')); ///*获取条数*/

//		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/
		$search_pattern = true;

		$name = request('name' ,'');
		$mobile = request('mobile' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$role = new BankeCashBackUser;

		$role = $role->where('status', 0);

		/*配置名称搜索*/
		if($name){
			if($search_pattern){
				$role = $role->where('name', 'like', $name);
			}else{
				$role = $role->where('name', $name);
			}
		}

		/*配置名称搜索*/
		if($mobile){
			if($search_pattern){
				$role = $role->where('mobile', 'like', $mobile);
			}else{
				$role = $role->where('mobile', $mobile);
			}
		}

		/*配置创建时间搜索*/
		if($created_at_from){
			$role = $role->where('created_at', '>=', getTime($created_at_from));
		}
		if($created_at_to){
			$role = $role->where('created_at', '<=', getTime($created_at_to, false));
		}

		/*配置修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
			$role = $role->where('created_at', '>=', getTime($updated_at_from));
		}
		if($updated_at_to){
			$role = $role->where('created_at', '<=', getTime($updated_at_to, false));
		}

		$count = $role->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$role = $role->orderBy($orderName, $orderDir);
		}

		$role = $role->offset($start)->limit($length);
		$roles = $role->get();

		if ($roles) {
			foreach ($roles as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $roles,
		];
	}

	/**
	 * 添加配置
	 * @author shaolei
	 * @date   2016-04-13T11:50:22+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		DB::transaction(function () use ($request) {
			try{
				$input = $request->all();
				$role = new BankeCashBackUser;
				$input['order_id'] = date("YmdHis").mt_rand(10, 99);
				$course = BankeCourse::find($input['course_id']);
				$input['period'] = $course['period'];
				$check_in_config = BankeDict::find(3);
				$input['check_in_amount'] = moneyFormat(($input['tuition_amount'] * $check_in_config['value'] / 100));
				$do_task_config = BankeDict::find(4);
				$input['do_task_amount'] = moneyFormat(($input['tuition_amount'] * $do_task_config['value'] / 100));
				$input['pay_tuition_time'] = date("Y-m-d H:i:s");
				$cur_user = Auth::user();
				$input['operator_uid'] = $cur_user->id;
				//创建新订单
				$role->fill($input)->save();
				//订单状态为已审核
				if($input['status'] == config('admin.global.status.active')){
					$userProfile = BankeUserProfiles::where('uid', $input['uid'])->lockForUpdate()->first();
					$userProfile->check_in_amount += $input['check_in_amount'];
					$userProfile->do_task_amount += $input['do_task_amount'];
					$userProfile->total_cashback_amount += ($input['check_in_amount'] + $input['do_task_amount']);
					$userProfile->period += $course['period'];
					//更新报名学生的信息
					$userProfile->save();
					//如果有邀请人
					if($userProfile->invitation_uid > 0) {
						$invitation_user = BankeUserProfiles::where('uid', $userProfile->invitation_uid)->lockForUpdate()->first();
						if ($invitation_user->do_task_amount > 0) {
							//邀请成功报名缴费
							$invite_enrol_config = BankeDict::find(7);
							$invitation_award = moneyFormat(($input['tuition_amount'] * $invite_enrol_config['value'] / 100));
							if($invitation_user->do_task_amount <= $invitation_award){
								$invitation_award = $invitation_user->do_task_amount;
							}
							$invitation_user->account_balance += $invitation_award;
							$invitation_user->do_task_amount -= $invitation_award;
							//更新邀请人信息
							$invitation_user->save();

							$message1 = [
								'uid'=>$userProfile->invitation_uid,
								'title'=>'好友报名成功',
								'content'=>'您邀请的好友'.$input['mobile'].'报名了课程！
								平台已帮您领取了'.$invitation_award
									.'元奖励，距离领完所有奖励又近了一大步！快去现金钱包里查看吧！',
								'type'=>'FRIEND_ENROL_SUCCESS'
							];
							//记录消息
							BankeMessage::create($message1);

							$balance_log = [
								'uid'=>$userProfile->invitation_uid,
								'change_amount'=>$invitation_award,
								'change_type'=>'+',
								'business_type'=>'INVITE_FRIEND_ENROL_SUCCESS',
								'operator_uid'=>$input['operator_uid']
							];
							//记录余额变动日志
							BankeBalanceLog::create($balance_log);
						}
					}
					$org = BankeOrg::find($input['org_id']);
					$message = [
						'uid'=>$input['uid'],
						'title'=>'报名成功',
						'content'=>'尊敬的'.$input['name'].'用户，您已'.date("Y-m-d").'于'.$org->name.'报名了'
							.$input['course_name'].'培训课程，学费为'.$input['tuition_amount'].'元，平台返现学费'
							.($check_in_config['value'] + $do_task_config['value']).'%，您的待返金额为'
							.($input['check_in_amount'] + $input['do_task_amount'])
							.'元，每次上课打卡和做任务即可领取',
						'type'=>'USER_ENROL_SUCCESS'
					];
					//记录消息
					BankeMessage::create($message);
				}
				Flash::success(trans('alerts.order.created_success'));
				return true;
			}catch (Exception $e){
				Log::info($e);
				Flash::error(trans('alerts.order.created_error'));
				return false;
			}
		});
	}
	/**
	 * 修改配置视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$role = BankeCashBackUser::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
		abort(404);
	}
	/**
	 * 修改配置
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeCashBackUser::find($id);
		$input = $request->only(['comment', 'status']);
		if ($role) {
			if($input['status'] == config('admin.global.status.active')){
				DB::transaction(function () use ($input, $role) {
					try{
						$cur_user = Auth::user();
						$input['operator_uid'] = $cur_user->id;
						//创建新订单
						$role->fill($input)->save();
						//订单状态为已审核
						$userProfile = BankeUserProfiles::where('uid', $role->uid)->lockForUpdate()->first();
						$userProfile->check_in_amount += $role['check_in_amount'];
						$userProfile->do_task_amount += $role['do_task_amount'];
						$userProfile->total_cashback_amount += ($role['check_in_amount'] + $role['do_task_amount']);
						$userProfile->period += $role->period;
						//更新报名学生的信息
						$userProfile->save();
						//如果有邀请人
						if($userProfile->invitation_uid > 0){
							$invitation_user = BankeUserProfiles::where('uid', $userProfile->invitation_uid)->lockForUpdate()->first();
							//剩余任务金额小于奖励金额，则返回剩余全部
							if($invitation_user->do_task_amount > 0){
								//邀请成功报名缴费
								$invite_enrol_config = BankeDict::find(7);
								$invitation_award = moneyFormat(($role['tuition_amount'] * $invite_enrol_config['value'] / 100));
								if($invitation_user->do_task_amount <= $invitation_award){
									$invitation_award = $invitation_user->do_task_amount;
								}
								$invitation_user->account_balance += $invitation_award;
								$invitation_user->do_task_amount -= $invitation_award;
								//更新邀请人信息
								$invitation_user->save();

								$message1 = [
									'uid'=>$userProfile->invitation_uid,
									'title'=>'您的好友报名成功',
									'content'=>'您邀请的好友'.$role->mobile.'报名了课程！
								平台已帮您领取了'.$invitation_award
										.'元奖励，距离领完所有奖励又近了一大步！快去现金钱包里查看吧！',
									'type'=>'FRIEND_ENROL_SUCCESS'
								];
								//记录消息
								BankeMessage::create($message1);

								$balance_log = [
									'uid'=>$userProfile->invitation_uid,
									'change_amount'=>$invitation_award,
									'change_type'=>'+',
									'business_type'=>'INVITE_FRIEND_ENROL_SUCCESS',
									'operator_uid'=>$input['operator_uid']
								];
								//记录余额变动日志
								BankeBalanceLog::create($balance_log);
							}
						}
						$org = BankeOrg::find($role->org_id);
						$cash_back_percent = BankeDict::whereIn('id', [3, 4])->sum('value');
						$message = [
							'uid'=>$role['uid'],
							'title'=>'您已报名成功',
							'content'=>'尊敬的'.$role->name.'用户，您已'.$role->pay_tuition_time.'于'.$org->name.'报名了'
								.$role->course_name.'培训课程，学费为'.$role->tuition_amount.'元，平台返现学费'
								.$cash_back_percent.'%，您的待返金额为'
								.($role->check_in_amount + $role->do_task_amount)
								.'元，每次上课打卡和做任务即可领取',
							'type'=>'USER_ENROL_SUCCESS'
						];
						//记录消息
						BankeMessage::create($message);
						Flash::success(trans('alerts.order.created_success'));
						return true;
					}catch (Exception $e){
						Log::info($e);
						Flash::error(trans('alerts.order.created_error'));
						return false;
					}
				});
			}else{
				//更新订单
				if($role->fill($input)->save()){
					Flash::success(trans('alerts.order.created_success'));
					return true;
				}
				Flash::error(trans('alerts.order.created_error'));
				return false;
			}
		}
		abort(404);
	}

	/**
	 * 修改配置状态
	 * @author shaolei
	 * @date   2016-04-13T11:51:02+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function mark($id,$status)
	{
		$role = BankeDict::find($id);
		if ($role) {
			$role->status = $status;
			if ($role->save()) {
				Flash::success(trans('alerts.dict.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.dict.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除配置
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeCashBackUser::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.order.soft_deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.order.soft_deleted_error'));
		return false;
	}

}