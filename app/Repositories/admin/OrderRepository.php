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
                                if($course->checkin_award){
                                    $input['check_in_amount']=moneyFormat(($input['tuition_amount'] * $course->checkin_award / 100));
                                }else{
                                    $check_in_config = BankeDict::find(3);
                                    $input['check_in_amount'] = moneyFormat(($input['tuition_amount'] * $check_in_config['value'] / 100));
                                }
                                if($course->task_award){
                                    $input['do_task_amount']=moneyFormat(($input['tuition_amount'] * $course->task_award / 100));
                                }else{
                                    $do_task_config = BankeDict::find(4);
                                    $input['do_task_amount'] = moneyFormat(($input['tuition_amount'] * $do_task_config['value'] / 100)); 
                                }
				
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
                                                                             
                                            //对比订单表中的截止日期与用户表中的截止日期 如果新增的订单课程的截止时间早于用户表中则将其更新到用户表中                                         
                                        if($input['end_date']>$userProfile->enddated_at){
                                            $userProfile->enddated_at= $input['end_date'];                                               
                                            //更新报名学生的信息
                                            $userProfile->save();
                                        }
                                                                                   
                                        //获取用户报名课程 的次数
                                        $courseCout= BankeCashBackUser::where(['uid'=>$role['uid'],'course_id'=>$role['course_id']])->count();
					//如果有邀请人
					if($userProfile->invitation_uid > 0 && $courseCout==0) {
						$invitation_user = BankeUserProfiles::where('uid', $userProfile->invitation_uid)->lockForUpdate()->first();
						if ($invitation_user->do_task_amount > 0) {
							//邀请成功报名缴费
								// 判断订单中的课程中的转奖励金额是否为空 如果为空则调用系统自动分配 否则取转奖励金额
							$invite_enrol_course =BankeCourse::find( $role->course_id);

//							if($invite_enrol_course['z_award_amount']==''){
//								$invite_enrol_config = BankeDict::find(7);
//							$invitation_award = moneyFormat(($input['tuition_amount'] * $invite_enrol_config['value'] / 100));
//							}else{
//								$invitation_award=$invite_enrol_course['z_award_amount'];
//							}

							$percent=$invite_enrol_course['z_award_amount'];
							if($percent==''){
								$percent= BankeDict::find(7)['value'];
//									$invitation_award = moneyFormat(($role['tuition_amount'] * $invite_enrol_config['value'] / 100));
							}
//								else{
//									$invitation_award=$invite_enrol_course['z_award_amount'];
//								}

							$invitation_award = moneyFormat(($role['tuition_amount'] * $percent / 100));
							

							//TODO 这里是否要去掉限制
//							if($invitation_user->do_task_amount <= $invitation_award){
//								$invitation_award = $invitation_user->do_task_amount;
//							}
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
							.$input['course_name'].'培训课程，学费为'.$input['tuition_amount'].'元，平台奖励学费'
							.($check_in_config['value'] + $do_task_config['value']).'%，您的待返金额为'
							.($input['check_in_amount'] + $input['do_task_amount'])
							.'元，每次上课打卡和做任务即可领取',
						'type'=>'USER_ENROL_SUCCESS'
					];
					//记录消息
					BankeMessage::create($message);
				}elseif ($input['status'] == config('admin.global.status.ban')){
					//详细规则未定
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
 
			if($role['status'] == config('admin.global.status.active')){
				Flash::error(trans('alerts.order.already_active'));
				return false;
			}
			if($input['status'] == config('admin.global.status.active')){
				DB::transaction(function () use ($input, $role) {
					try{  
						$cur_user = Auth::user();
						$input['operator_uid'] = $cur_user->id;                                               
						$role->fill($input)->save();
                                                 //var_dump($role);die;
						//订单状态为已审核
                                                 // var_dump($end_date);die;
                                                
						$userProfile = BankeUserProfiles::where('uid', $role->uid)->lockForUpdate()->first();
						$userProfile->check_in_amount += $role['check_in_amount'];
						$userProfile->do_task_amount += $role['do_task_amount'];
						$userProfile->total_cashback_amount += ($role['check_in_amount'] + $role['do_task_amount']);
						$userProfile->period += $role->period;
					   //对比订单表中的截止日期与用户表中的截止日期 如果新增的订单课程的截止时间早于用户表中则将其更新到用户表中
						if($role->end_date>$userProfile->enddated_at){
							$userProfile->enddated_at= $role->end_date;
						}
						//更新报名学生的信息
						$userProfile->save();                                                                                           
						//获取用户报名课程 的次数
						 $courseCout= BankeCashBackUser::where(['uid'=>$role['uid'],'course_id'=>$role['course_id']])->count();
						   //var_dump($userProfile->invitation_uid) ;die;
						//如果有邀请人(添加一个条件：且该用户是第一次报这个课程)
						if($userProfile->invitation_uid > 0 && $courseCout==1){                                                  
							$invitation_user = BankeUserProfiles::where('uid', $userProfile->invitation_uid)->lockForUpdate()->first();
							//剩余任务金额小于奖励金额，则返回剩余全部
								//邀请成功报名缴费
								// 判断订单中的课程中的转奖励金额是否为空 如果为空则调用系统自动分配 否则取转奖励金额
								$invite_enrol_course =BankeCourse::find( $role->course_id);

								$percent=$invite_enrol_course['z_award_amount'];
								if($percent==''){
									$percent= BankeDict::find(7)['value'];
								}

								$invitation_award = moneyFormat(($role['tuition_amount'] * $percent / 100));
//
								$invitation_user->account_balance += $invitation_award;

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
						$org = BankeOrg::find($role->org_id);
						$cash_back_percent = BankeDict::whereIn('id', [3, 4])->sum('value');
                                                //var_dump($org);die;
						$message = [
							'uid'=>$role['uid'],
							'title'=>'您已报名成功',
							'content'=>'尊敬的'.$role->name.'用户，您已'.$role->pay_tuition_time.'于'.$org->name.'报名了'
								.$role->course_name.'培训课程，学费为'.$role->tuition_amount.'元，平台奖励学费'
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
		}else{
			abort(404);
		}
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



}