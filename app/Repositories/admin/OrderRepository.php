<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeBalanceLog;
use App\Models\Banke\BankeCashBackUser;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeDict;
use App\Models\Banke\BankeEnrol;
use App\Models\Banke\BankeMessage;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeUserAuthentication;
use App\Models\Banke\BankeUserProfiles;
use App\Models\Banke\BankeWithdraw;
use Carbon\Carbon;
use Flash;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;

/**
* 订单（报名）仓库
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
		$status = request('status' ,'');
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
		/*状态搜索*/
		if ($status!=null) {
			$role = $role->where('status', $status);
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
		$roles = $role->orderBy("id", "desc")->get();

		if ($roles) {
			foreach ($roles as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(true);
				$v['org_name'] = $v->org['name'];
				$had_check_in_days=CheckinRepository::getHadCheckinDaysByUIdAndCid($v['uid'],$v['course_id']);
				$v['had_check_in_days'] = $had_check_in_days;
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
		$roles = $role->orderBy("id", "desc")->get();

		if ($roles) {
			foreach ($roles as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(true);
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
	 * 审核订单
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$order = BankeCashBackUser::find($id);
		$input = $request->only(['comment', 'status']);
		if ($order) {
			//重复订单
			$isRepeat=BankeCashBackUser::where(['course_id'=>$order->course_id,'uid'=>$order->uid,'status'=>1])->count()>0;

			if($order['status'] == config('admin.global.status.active') || $isRepeat){
				Flash::error(trans('alerts.order.already_active'));
				return false;
			}
			$cur_user = Auth::user();
			$operator_id=$cur_user->id;
			$order=$order->fill($input);
			if($input['status'] == config('admin.global.status.active')){
				DB::transaction(function () use ($input, $order,$operator_id) {
					try{
						$order->save();
						$userProfile = BankeUserProfiles::where('uid', $order->uid)->lockForUpdate()->first();

						$this->execUpadateUserInfo($order,$userProfile); //更新用户信息

						$this->execUpadateInvitorInfo($order);//更新推荐用户信息，并发送app内消息

						$this->sendMsgToUser($order);  //给用户发送app内消息

						//更新机构的学习人数
						$org = $order->org;
						$org->student_counts++;
						$org->save();

						DB::commit();
						Flash::success(trans('alerts.order.authen_success'));
						return true;
					}catch (Exception $e){
						DB::rollBack();
						Log::info($e);
						Flash::error(trans('alerts.order.authen_error'));
						return false;
					}
				});
			}
			else{
				$result = $order->save();
				//更新订单
				if($result){
					Flash::success(trans('alerts.order.authen_success'));
					return true;
				}
				Flash::error(trans('alerts.order.authen_error'));
				return false;
			}
		}else{
			abort(404);
		}
	}

	//更新用户表的信息，包括报名获得奖励，//订单状态为已审核
	private  function  execUpadateUserInfo($order,$userProfile){
		$userProfile->check_in_amount += $order['check_in_amount'];
		$userProfile->do_task_amount += $order['do_task_amount'];
		$userProfile->total_cashback_amount += ($order['check_in_amount'] + $order['do_task_amount']);
		$userProfile->period += $order->period;
		//对比订单表中的截止日期与用户表中的截止日期 如果新增的订单课程的截止时间早于用户表中则将其更新到用户表中
		if($order->end_date>$userProfile->enddated_at){
			$userProfile->enddated_at= $order->end_date;
		}
		//更新报名用户的信息
		$userProfile->save();
	}

	/*
	 * 更新推荐人的用户的信息，推荐人获得奖励
	 * 是否有推荐人 从 预约表中查找  课程id，手机号一致才算，如果有多条，取最早的
	 */
	private  function  execUpadateInvitorInfo($order){
		$course_id=$order->course_id;
		$enrol=BankeEnrol::where(['course_id'=>$course_id,'mobile'=>$order->mobile]);
		if($enrol && $enrol->count()>0){
			$invitation_uid=$enrol->first()->invitation_uid;
			$invitation_user = BankeUserProfiles::where('uid', $invitation_uid)->lockForUpdate()->first();
			if ($invitation_user) {

				// 判断订单中的课程中的转奖励金额是否为空 如果为空则调用系统自动分配 否则取转奖励金额
				$invite_enrol_course = BankeCourse::find($course_id);
				$percent = $invite_enrol_course['z_award_amount'];
				if ($percent == '') {
					$percent = BankeDict::find(7)['value'];
				}
				$invitation_award = moneyFormat(($order['tuition_amount'] * $percent / 100));

				//更新用户账户金额信息以及添加变动记录
				AppUserRepository::execUpdateUserAccountInfo($invitation_uid, $invitation_award, 1, 3);

				$message1 = [
					'uid' => $invitation_uid,
					'title' => '您的好友报名成功',
					'content' => '您邀请的好友' . $order->mobile . '报名了课程！平台已帮您领取了' . $invitation_award
						. '元奖励，距离领完所有奖励又近了一大步！快去现金钱包里查看吧！',
					'type' => 'FRIEND_ENROL_SUCCESS'
				];
				//记录消息
				BankeMessage::create($message1);
			}
		}
	}

	//给用户发送app消息
	private  function sendMsgToUser($order){
		$org = $order->org;
		$cash_back_percent = BankeDict::whereIn('id', [3, 4])->sum('value');
		$message = [
			'uid'=>$order['uid'],
			'title'=>'您已报名成功',
			'content'=>'尊敬的'.$order->name.'用户，您已'.$order->pay_tuition_time.'于'.$org->name.'报名了'
				.$order->course_name.'培训课程，学费为'.$order->tuition_amount.'元，平台奖励学费'
				.$cash_back_percent.'%，您的待返金额为'
				.($order->check_in_amount + $order->do_task_amount)
				.'元，每次上课打卡和做任务即可领取',
			'type'=>'USER_ENROL_SUCCESS'
		];
		//记录消息
		BankeMessage::create($message);

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

	/**
	 * 修改配置视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$order = BankeCashBackUser::find($id)->toArray();
		return $order;
	}

	/**
	 * 根据创建时间，得到 报名用户
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function getUserInLimitTime($startTime,$endTime)
	{
		$user = new BankeCashBackUser;
		$user = $user->where('created_at','>=',getTime($startTime));
		$user = $user->where('created_at','<',getTime($endTime))->get(['uid','name','created_at']);
		return $user;
	}

	/**
	 * 根据创建时间，得到 注册半课APP用户 分组，每天多少人
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function getUserInLimitTimeByGroup($startTime,$endTime)
	{
		$user = new BankeCashBackUser();
		$user = $user::where('created_at','>=',getTime($startTime));
		$user = $user->where('created_at','<',getTime($endTime));
		$user = $user->groupBy('date')
			->orderBy('date','DESC')
			->get([
				DB::raw('Date(created_at) as date'),
				DB::raw('COUNT(*) as value')
			])
			->toJSON();
		return $user;
	}


	/**
	 * 根据用户手机号得到他的全部订单
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function search_by_mobile()
	{
		$mobile = request('mobile', '');

		$user_info = new BankeUserAuthentication();
		$user_info = $user_info->where('mobile', $mobile);

		$uid = 0;
		$order = new BankeCashBackUser;
		if ($user_info->count() > 0) {
			$user_info=$user_info->first();
			$uid =$user_info['uid'];
			$order = $order->where('uid', $uid);
			$order = $order->where('status', 1)->get(['course_name', 'order_id','tuition_amount']);
			if ($order) {
				foreach ($order as &$v) {
					$v['real_name'] = $user_info['real_name'];
				}
			}

			return $order;
		}else{
			$order = $order->where('uid', $uid);
			return $order->get();
		}

	}


	/**添加订单
	 * 为了简便，方便管理，只能添加未审核订单
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
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
				$do_task_config = BankeDict::find(4);
				if($course->checkin_award){
					$input['check_in_amount']=moneyFormat(($input['tuition_amount'] * $course->checkin_award / 100));
				}else{
					$input['check_in_amount'] = moneyFormat(($input['tuition_amount'] * $check_in_config['value'] / 100));
				}
				if($course->task_award){
					$input['do_task_amount']=moneyFormat(($input['tuition_amount'] * $course->task_award / 100));
				}else{
					$input['do_task_amount'] = moneyFormat(($input['tuition_amount'] * $do_task_config['value'] / 100));
				}

				$input['pay_tuition_time'] = date("Y-m-d H:i:s");

				$cur_user = Auth::user();
				$input['operator_uid'] = $cur_user->id;
				//创建新订单
				$role->fill($input)->save();

				Flash::success(trans('alerts.order.created_success'));
				return true;
			}catch (Exception $e){
				Log::info($e);
				Flash::error(trans('alerts.order.created_error'));
				return false;
			}
		});
	}



}