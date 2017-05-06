<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeBalanceLog;
use App\Models\Banke\BankeCashBackUser;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeDict;
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
	 * 修改配置
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
 
			if($order['status'] == config('admin.global.status.active')){
				Flash::error(trans('alerts.order.already_active'));
				return false;
			}
			$cur_user = Auth::user();
			$operator_id=$cur_user->id;
			$result = $order->fill($input)->save();

			if($input['status'] == config('admin.global.status.active')){
				DB::transaction(function () use ($input, $order,$operator_id) {
					try{
						$userProfile = BankeUserProfiles::where('uid', $order->uid)->lockForUpdate()->first();

						$this->execUpadateUserInfo($order,$userProfile); //更新用户信息

						$this->execUpadateInvitorInfo($order,$userProfile,$operator_id);//更新推荐用户信息，并发送短信

						$this->sendMsgToUser($order);  //给用户发送短信

						//更新机构的学习人数
						$org = $order->org;
						$org->student_counts++;
						$org->save();

						DB::commit();
						Flash::success(trans('alerts.order.created_success'));
						return true;
					}catch (Exception $e){
						DB::rollBack();
						Log::info($e);
						Flash::error(trans('alerts.order.created_error'));
						return false;
					}
				});
			}
			else{
				//更新订单
				if($result){
					Flash::success(trans('alerts.order.created_success'));
					return true;
				}
				Flash::error(trans('alerts.order.created_error'));
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

	//更新推荐人的用户的信息，包括推荐报名获得奖励，//订单状态为已审核
	private  function  execUpadateInvitorInfo($order,$userProfile,$operator_id){
		//获取用户报名课程 的次数
		$courseCout= BankeCashBackUser::where(['uid'=>$order['uid']])->count();

		//如果有邀请人(添加一个条件：且该用户是第一次报课程)
		if($userProfile->invitation_uid > 0 && $courseCout==1){
			$invitation_user = BankeUserProfiles::where('uid', $userProfile->invitation_uid)->lockForUpdate()->first();
			//剩余任务金额小于奖励金额，则返回剩余全部
			//邀请成功报名缴费
			// 判断订单中的课程中的转奖励金额是否为空 如果为空则调用系统自动分配 否则取转奖励金额
			$invite_enrol_course =BankeCourse::find( $order->course_id);

			$percent=$invite_enrol_course['z_award_amount'];
			if($percent==''){
				$percent= BankeDict::find(7)['value'];
			}

			$invitation_award = moneyFormat(($order['tuition_amount'] * $percent / 100));
//
			$invitation_user->account_balance += $invitation_award;
			//将给邀请人的奖励累加到邀请人做任务已领的奖励中
			$invitation_user->get_do_task_amount+=$invitation_award;

			//更新邀请人信息
			$invitation_user->save();
			$message1 = [
				'uid'=>$userProfile->invitation_uid,
				'title'=>'您的好友报名成功',
				'content'=>'您邀请的好友'.$order->mobile.'报名了课程！
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
				'operator_uid'=>$operator_id
			];
			//记录余额变动日志
			BankeBalanceLog::create($balance_log);
		}
	}

	//给用户发送短信
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
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
//		$course = new BankeCourse;
//		if ($course->fill($request->all())->save()) {
//			Flash::success(trans('alerts.course.created_success'));
//			return $course->id;
//		}
//		Flash::error(trans('alerts.course.created_error'));
//		return false;
	}



}