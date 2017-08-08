<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeBalanceLog;
use App\Models\Banke\BankeCashBackUser;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeDict;
use App\Models\Banke\BankeEnrol;
use App\Models\Banke\BankeGroupbuying;
use App\Models\Banke\BankeMessage;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeUserAuthentication;
use App\Models\Banke\BankeUserProfiles;
use App\Models\Banke\BankeGroupbuyingUsers;
use App\Models\Banke\BankeWithdraw;
use Carbon\Carbon;
use Flash;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;
use MoneyNewsRepository;
use DailyTaskLogRepository;
use InvitationSignUpRepository;
use OrderDepositRepository;

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
				Flash::error(trans('alerts.common.already_active'));
				return false;
			}
			$cur_user = Auth::user();
			$operator_id=$cur_user->id;
			$order=$order->fill($input);
			if($input['status'] == config('admin.global.status.active')){
				DB::transaction(function () use ($input, $order,$operator_id) {
					try{
						$uid=$order->uid;

						//更新机构的学习人数
						$org = $order->org;
						$org->student_counts++;
						$org->save();

						$order->save();

						//更新订金表信息
						OrderDepositRepository::updateOutLineStatus($uid,$order->course_id);

						$userProfile = BankeUserProfiles::where('uid', $uid)->lockForUpdate()->first();

						$this->execUpadateUserInfo($order,$userProfile); //更新用户信息

						GroupbuyingRepository::execUpadateGroupbuyingUsersInfo($order);//更新参团信息

						$this->execUpadateInvitorInfo($order,$org);//更新推荐用户信息，并发送app内消息

						$this->sendMsgToUser($order);  //给用户发送app内消息


						//将报名赚钱信息添加到赚钱动态表中
						$info=[
							'uid'=>$uid,
							'amount'=>$order->do_task_amount+$order->check_in_amount,
							'business_type'=>'ENROL_SUCCESS',
							'org_id'=>$org->id
						];
						MoneyNewsRepository::addRecordToMeoneyNewsFromSystem($info);

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

	/*
	 * 更新用户表的信息，包括报名获得奖励
	 * 如果是老学员则变成新学员
	 * 订单状态为已审核
	*/
	private  function  execUpadateUserInfo($order,$userProfile){
		$userProfile->check_in_amount += $order['check_in_amount'];
		$userProfile->do_task_amount += $order['do_task_amount'];
		$userProfile->total_cashback_amount += ($order['check_in_amount'] + $order['do_task_amount']);
		$userProfile->period += $order->period;
		//对比订单表中的截止日期与用户表中的截止日期 如果新增的订单课程的截止时间早于用户表中则将其更新到用户表中
		if($order->end_date>$userProfile->enddated_at){
			$userProfile->enddated_at= $order->end_date;
		}

		//v1.7 老学员变成新学员
		if($userProfile->user_type==2) {
			$userProfile->user_type = 1;
		}
		//更新报名用户的信息
		$userProfile->save();
	}

	/*
	 * 更新推荐人的用户的信息，推荐人获得奖励
	 * 是否有推荐人 从 预约表中查找  课程id，手机号一致才算，如果有多条，取最早的
	 */
	private  function  execUpadateInvitorInfo($order,$org){
		$course_id=$order->course_id;
		$enrol=BankeEnrol::where(['course_id'=>$course_id,'mobile'=>$order->mobile]);  //预约表查询
		if($enrol && $enrol->count()>0) {
			$enrol = $enrol->first();
			$enrol->order_status = 1;  //更新预约信息，表示真实报名了
			$enrol->save();
			$invitation_uid = $enrol->invitation_uid;

			if ($invitation_uid != 0) {

				//v1.8 更新每日任务信息，并对每天是否能奖励做过滤
				$award_flag = DailyTaskLogRepository::updateBankeDailyTaskLog($invitation_uid, 0);

				// 奖励金额比例使用实时课程的数值，金额底数，使用被邀请者的成交价
				$invite_enrol_course = BankeCourse::find($course_id);

				if ($enrol->invitorUserSimple['user_type'] >= 3) {
					$percent = $invite_enrol_course['z_award_amount_teacher'];
				} else {
					$percent = $invite_enrol_course['z_award_amount'];
				}
				$invitation_award = moneyFormat(($order['tuition_amount'] * $percent / 100));

				//写入invitation signup
				$new_award=0;
				if($award_flag){
					$new_award=$invitation_award;
				}
				$this->addInvationSingUpRecord($order,$invitation_uid,$new_award);

				if ($award_flag) {

					$order_invitor = BankeCashBackUser::where(['course_id' => $course_id, 'uid' => $invitation_uid, 'status' => 1])->first();

					// v1.7之前版本,和之后版本做区别
					$groupbuying_flag = $this->dealwithOrderFromType($course_id, $invitation_uid, $invitation_award);
					if (!$groupbuying_flag) {
						//更新邀请人的订单信息，已获邀请金额 + award
						$order_invitor = BankeCashBackUser::where(['course_id' => $course_id, 'uid' => $invitation_uid, 'status' => 1]);
						if ($order_invitor->count() > 0) {
							$order_invitor = $order_invitor->first();
							$order_invitor->get_group_buying_amount += $invitation_award;  //已经获得的开团金额金额 += $award
							$order_invitor->save();
						}
					}
					//更新用户账户金额信息以及添加变动记录
					AppUserRepository::execUpdateUserAccountInfo($invitation_uid, $invitation_award, 1, 3);

					$message1 = [
						'uid' => $invitation_uid,
						'title' => '您的好友报名成功',
						'content' => '您邀请的好友 ' . $order->mobile . ' 报名了课程——' . $order['course_name'] . '。平台已帮您领取了' . $invitation_award
							. '元奖励，距离领完所有奖励又近了一大步！快去现金钱包里查看吧！',
						'type' => 'FRIEND_ENROL_SUCCESS'
					];
					//记录消息
					BankeMessage::create($message1);


					//将报名赚钱信息添加到赚钱动态表中
					$info = [
						'uid' => $invitation_uid,
						'invited_uid' => $order->uid,
						'cut_amount' => $order->do_task_amount + $order->check_in_amount,
						'amount' => $invitation_award,
						'business_type' => 'INVITE_FRIEND_ENROL_SUCCESS',
						'org_id' => $org->id
					];
					MoneyNewsRepository::addRecordToMeoneyNewsFromSystem($info);
				}
			}
		}
	}

	private function addInvationSingUpRecord($order,$invitation_uid,$invitation_award){
		$invitaionInfo = [
			'uid'=> $order->uid,
			'course_id'=>$order->course_id,
			'course_name'=>$order->course_name,
			'tuition_amount'=>$order->tuition_amount,
			'invitor_id'=>$invitation_uid,
			'invitor_award_amount'=>$invitation_award,
			'status'=>1,
		];
		InvitationSignUpRepository::store($invitaionInfo);
	}

	/*
	 * v1.7之前版本：
	 * A 报名了课程，开团邀请好友B报名。审核B订单时，查询预约表，发现是 A 邀请的，给A奖励：操作用户表，更新A的任务奖励金额和余额信息；操作订单表，更新 get_group_buying_amount。
	 *
	 * v1.7之后版本：
	 * A 不报名课程，开团邀请好友B报名。审核B订单时，查询预约表，发现是 A 邀请的，给A奖励：操作用户表，更新A的任务奖励金额和余额信息；操作开团表，更新 get_group_buying_amount。。
	 * 区分开团的来源，从from 来区分，0表示来源于订单，即 v1.7之前；1为v1.7新方式
	 */
	private  function dealwithOrderFromType($course_id,$uid,$award)
	{
		$groupbuying = BankeGroupbuying::where(['course_id'=>$course_id,'organizer_id'=>$uid,'status'=>1]);
		if($groupbuying->count()>0) {
			$groupbuying = $groupbuying->first();
			if($groupbuying['from']==1) {
				$groupbuying->get_group_buying_amount += $award;  //已经获得的开团金额金额 += $award
				$groupbuying->save();
				return true;
			}else {
				return false;
			}
		}
		return false;
	}

	//给用户发送app消息
	private  function sendMsgToUser($order){
		$course = $order->course;
		$cash_back_percent =  $course->task_award + $course->checkin_award;
		$message = [
			'uid'=>$order['uid'],
			'title'=>'您已报名成功',
			'content'=>'报名课程：'.$order->course_name .'。'.
				' 报名时间： ' .$order->pay_tuition_time.'。'.
				' 学费：' .$order->tuition_amount.'元。'.
				' 平台奖励：' .$cash_back_percent.'%，待返金额为 ' .($order->check_in_amount + $order->do_task_amount) .'元，'.
				' 每次上课打卡和做任务即可领取。',
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
	public static function getOrderInLimitTime($startTime,$endTime=null)
	{
		$user = new BankeCashBackUser;
		$user = $user->where('created_at','>=',getTime($startTime));
		if($endTime) {
			$user = $user->where('created_at', '<', getTime($endTime));
		}
		$user=$user->where('status',1)->get(['uid', 'name', 'created_at']);
		return $user;
	}

	/**
	 * 根据创建时间，得到 每天报名多少人
	 * @author jimmy
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public static function getOrderInLimitTimeByGroup($startTime,$endTime)
	{
		$user = new BankeCashBackUser();
		$user = $user::where('created_at','>=',getTime($startTime));
		$user = $user->where('created_at','<',getTime($endTime));
		$user = $user->where('status','1');
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
				$order = new BankeCashBackUser;
				$input['order_id'] = date("YmdHis").mt_rand(10, 99);
				$course = BankeCourse::find($input['course_id']);

				$tuition=$input['tuition_amount'];
				$input['period'] = $course['period'];
				$input['check_in_amount']=moneyFormat($tuition * $course->checkin_award / 100);
				$input['do_task_amount']=moneyFormat($tuition * $course->task_award / 100);

				//获取课程信息，计算任务分享信息

				//course
				$commentCourseAward=moneyFormat($tuition*$course['share_comment_course_award']/100);
				$commentCourseCounts=$course['share_comment_course_counts'];//最多可以奖励次数
				$input['share_comment_course_amount'] = $commentCourseAward;
				$input['share_comment_course_counts'] = $commentCourseCounts;
				$input['share_comment_course_view_counts'] = $this->getViewCountsByAward($commentCourseAward,$commentCourseCounts);  //浏览多少次达到要求

				$org=$course->org;

				//org
				$commentOrgAward=moneyFormat($tuition*$org['share_comment_org_award']/100);
				$commentOrgCounts=$org['share_comment_org_counts'];//最多可以奖励次数
				$input['share_comment_org_amount'] =$commentOrgAward;
				$input['share_comment_org_counts'] = $commentOrgCounts;
				$input['share_comment_org_view_counts'] = $this->getViewCountsByAward($commentOrgAward,$commentOrgCounts);

				//groupbuying
				$gbAllAward=moneyFormat($tuition*$course['group_buying_award']/100);
				$input['group_buying_amount'] = $gbAllAward;

				$gbAward=moneyFormat($tuition*$course['share_group_buying_award']/100);
				$gbCounts=$course['share_group_buying_counts'];//最多可以奖励次数

				$input['share_group_buying_amount'] = $gbAward;
				$input['share_group_buying_counts'] = $gbCounts;
				$input['share_group_buying_view_counts'] = $this->getViewCountsByAward($gbAward,$gbCounts);


				$input['pay_tuition_time'] = date("Y-m-d H:i:s");

				$cur_user = Auth::user();
				$input['operator_uid'] = $cur_user->id;

				//创建新订单
				$order->fill($input)->save();

				Flash::success(trans('alerts.order.created_success'));
				return true;
			}catch (Exception $e){
				Log::info($e);
				Flash::error(trans('alerts.order.created_error'));
				return false;
			}
		});
	}


	/*
	 * 分享的页面需要浏览几次才能达到奖励标准，和金额1:1对应。向下取整
	 * @author jimmy
	 * @date   2016-04-13T11:51:19+0800
	 * @param  $award [number]   奖项
	 * @return $maxCounts [number]   最多可以获得多少次奖励
	 * */
	private static function getViewCountsByAward($award,$maxCounts){
		$temp =floor ($award/$maxCounts);
		return $temp;
	}


	/**
	 * 通过课程id,用户id，得到订单
	 * @author jimmy
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public static function getOrderByCouseIdAndUid($course_id,$uid)
	{
		$order = BankeCashBackUser::where(['course_id'=>$course_id,'uid'=>$uid,'status'=>1])->first();
		return $order;
	}

	/**
	 * 根据机构id得到订单的数量
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public static function getOrderInfoByOrgId($oid)
	{
		$allOrders=BankeCashBackUser::where(['org_id'=>$oid,'status'=>1])->get();
		$totalAccount=0;
		foreach($allOrders as $v){
			$totalAccount +=$v->tuition_amount;
		}
		return ['counts'=>$allOrders->count(),'account'=>$totalAccount];

	}

}