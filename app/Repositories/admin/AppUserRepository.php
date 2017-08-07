<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeBalanceLog;
use App\Models\Banke\BankeInvitation;
use App\Models\Banke\BankeMessage;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeUserProfiles;
use App\Models\Banke\BankeUserAuthentication;
use App\Models\Banke\BankeDict;
use App\User;
use Carbon\Carbon;
use Flash;
use DB;
use Auth;
use League\Flysystem\Exception;
use App\Uuid;
use Illuminate\Support\Facades\Log;
use MoneyNewsRepository;

/**
* app用户仓库
*/
class AppUserRepository
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

		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/

		$name = request('name' ,'');
		$mobile = request('mobile' ,'');
		$status = request('certification_status' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$user = new BankeUserProfiles;

		/*名称搜索*/
		if($name){
			if($search_pattern){
				$user = $user->where('name', 'like', $name);
			}else{
				$user = $user->where('name', $name);
			}
		}

		/*手机搜索*/
		if($mobile){
			if($search_pattern){
				$user = $user->where('mobile', 'like', $mobile);
			}else{
				$user = $user->where('mobile', $mobile);
			}
		}
		
		/*状态搜索*/
		if ($status!=null) {
			$user = $user->where('certification_status', $status);
		}

		/*创建时间搜索*/
		if($created_at_from){
			$user = $user->where('created_at', '>=', getTime($created_at_from));	
		}
		if($created_at_to){
			$user = $user->where('created_at', '<=', getTime($created_at_to, false));	
		}

		/*修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
			$user = $user->where('created_at', '>=', getTime($updated_at_from));	
		}
		if($updated_at_to){
			$user = $user->where('created_at', '<=', getTime($updated_at_to, false));	
		}

		$count = $user->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$user = $user->orderBy($orderName, $orderDir);
		}

		$user = $user->offset($start)->limit($length);
		$users = $user->orderBy("uid", "desc")->get();

		if ($users) {
			foreach ($users as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
				$cur_user = BankeUserAuthentication::find($v['uid']);
				$v['real_name'] = $cur_user['real_name'];
				$v['withdraw_amount']=0;
//				if($cur_user->withdraws) {
//					$v['withdraw_amount'] = $cur_user->withdraws->where('status', 1)->sum('withdraw_amount');
//					$cur_user->withdraw;
//				}
			}
		}
		
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $users,
		];
	}


	/*得到单个用户的详细信息*/
	public static  function  getUserAllDetailInfo($id){
		$user = new BankeUserProfiles;
		$user=$user::find($id);
		if($user){
			$authen =$user->authentication;
			if($authen['real_name']){
				$user['name']=$authen['real_name'];
				$user['zhifubao_account']=$authen['zhifubao_account'];
				$user['school']=$authen['school'];
				$user['major']=$authen['major'];
			}
			return $user;
		}
		else{
			abort(404);
		}
	}

	/**
	 * datatable获取数据
	 * @author shaolei
	 * @date   2016-04-13T21:14:37+0800
	 * @return [type]                   [description]
	 */
	public function ajaxCertification()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.global.list.start')); /*获取开始*/
		$length = request('length', config('admin.global.list.length')); ///*获取条数*/

		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/

		$name = request('real_name' ,'');
		$mobile = request('mobile' ,'');
		$school = request('school' ,'');
		$major = request('major' ,'');
		$status = request('certification_status' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$user = new BankeUserAuthentication;

		$user = $user->where('certification_status', '>', 0);

		/*名称搜索*/
		if($name){
			if($search_pattern){
				$user = $user->where('real_name', 'like', $name);
			}else{
				$user = $user->where('real_name', $name);
			}
		}

		/*手机搜索*/
		if($mobile){
			if($search_pattern){
				$user = $user->where('mobile', 'like', $mobile);
			}else{
				$user = $user->where('mobile', $mobile);
			}
		}

		/*学校搜索*/
		if($school){
			if($search_pattern){
				$user = $user->where('school', 'like', $school);
			}else{
				$user = $user->where('school', $school);
			}
		}

		/*专业搜索*/
		if($major){
			if($search_pattern){
				$user = $user->where('major', 'like', $major);
			}else{
				$user = $user->where('major', $major);
			}
		}

		/*状态搜索*/
		if ($status) {
			$user = $user->where('certification_status', $status);
		}

		/*创建时间搜索*/
		if($created_at_from){
			$user = $user->where('created_at', '>=', getTime($created_at_from));
		}
		if($created_at_to){
			$user = $user->where('created_at', '<=', getTime($created_at_to, false));
		}

		/*修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
			$user = $user->where('created_at', '>=', getTime($updated_at_from));
		}
		if($updated_at_to){
			$user = $user->where('created_at', '<=', getTime($updated_at_to, false));
		}

		$count = $user->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$user = $user->orderBy($orderName, $orderDir);
		}

		$user = $user->offset($start)->limit($length);
		$users = $user->orderBy("updated_at", "desc")->get();

		if ($users) {
			foreach ($users as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
			}
		}

		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $users,
		];
	}

	/**
	 * 修改用户身份认证状态
	 * @author shaolei
	 * @date   2016-04-14T11:50:45+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function certificate($id,$status)
	{
		$user = BankeUserAuthentication::find($id);
		if($user){
			DB::transaction(function () use ($id, $status, $user) {
				try {
					$user_profile = BankeUserProfiles::where('uid', $id)->lockForUpdate()->first();
					$certification_time = date("Y-m-d H:i:s");
					$cur_user = Auth::user();
					$user->operator_uid = $cur_user->id;
					$user->certification_status = $status;
					$user->certification_time = $certification_time;
					//同步认证状态，处理认证奖励金额
					$user_profile->certification_status = $status;
					$user_profile->certification_time = $certification_time;
					$user->save();
					//处理邀请人奖励金额
					if($status == config('admin.global.certification_status.audit')){
						//查询系统配置里注册认证的奖金
						$register_award = BankeDict::where('id', 1)->first();
						$user_profile->account_balance += $register_award->value;
						$user_profile->register_amount += $register_award->value;
						//将用户注册认证的金额加到用户表做任务已领金额中
						$user_profile->get_do_task_amount+= $register_award->value;
						$balance_log = [
							'uid'=>$id,
							'change_amount'=>$register_award->value,
							'change_type'=>'+',
							'business_type'=>'REGISTER_AND_CERTIFICATE_SUCCESS',
							'operator_uid'=>$cur_user->id
						];
						//记录余额变动日志
						BankeBalanceLog::create($balance_log);
						$message1 = [
							'uid'=>$id,
							'title'=>'认证成功',
							'content'=>'您的认证信息审核通过，平台已奖励您'.$register_award->value.'元现金，快去现金钱包里查看吧！',
							'type'=>'USER_CERTIFICATE_SUCCESS'
						];
						//记录消息
						BankeMessage::create($message1);


						//v1.7招生老师审核时，所以此处不奖励
						if($user_profile->user_type!=3){

							$invitor_id=$user_profile->invitation_uid;

							//v1.8 更新每日任务信息，并对每天是否能奖励做过滤
							$award_flag = DailyTaskLogRepository::updateBankeDailyTaskLog($invitor_id,3);
							if ($invitor_id > 0 && $award_flag) {

								$invitation_user = BankeUserProfiles::where('uid', $invitor_id)->lockForUpdate()->first();
								//查询系统配置里邀请人注册认证的奖金
								$award_amount = BankeDict::where('id', 2)->first()->value;
								$invitation_user->invitation_amount += $award_amount;

								$invitation_user->account_balance += $award_amount;

								//将邀请他人注册认证的奖金加大做任务的已领金额中去
								$invitation_user->get_do_task_amount += $award_amount;

								$invitation_user->save();

								//更新邀请表 的奖励金额
								$this->updateInvitationTableInfo($invitor_id,$user_profile->mobile,$award_amount);

								$balance_log1 = [
									'uid' => $user_profile->invitation_uid,
									'change_amount' => $award_amount,
									'change_type' => '+',
									'business_type' => 'INVITE_FRIEND_REGISTER_AND_CERTIFICATE_SUCCESS',
									'operator_uid' => $cur_user->id
								];
								//记录余额变动日志
								BankeBalanceLog::create($balance_log1);

								$message3 = [
									'uid' => $user_profile->invitation_uid,
									'title' => '好友认证成功',
									'content' => '您的好友' . $user_profile->mobile . '已经认证成功！平台已奖励您'
										. $award_amount . '元现金，快去现金钱包里查看吧！',
									'type' => 'FRIEND_CERTIFICATE_SUCCESS'
								];
								//记录消息
								BankeMessage::create($message3);
							}
						}
					}elseif($status == config('admin.global.certification_status.trash')){
						$message2 = [
							'uid'=>$id,
							'title'=>'您已认证失败',
							'content'=>'您的认证信息未通过审核，请重新提交申请',
							'type'=>'USER_CERTIFICATE_FAIL'
						];
						//记录消息
						BankeMessage::create($message2);
					}
					//同步认证状态
					$user_profile->save();
					DB::commit();
					Flash::success(trans('alerts.app_user.certificate_success'));
					return true;
				} catch (Exception $e) {
					DB::rollback();
					Flash::error(trans('alerts.app_user.certificate_error'));
					var_dump($e);
					return false;
				}
			});
		}else{
			abort(404);
		}
	}

	//更新邀请表 的奖励金额
	public function  updateInvitationTableInfo($uid,$targetMobile,$award_amount)
	{
		$invitation_table=BankeInvitation::where(['target_mobile'=>$targetMobile,'uid'=>$uid])->first();
		$invitation_table->award_amount=$award_amount;
		$invitation_table->save();
	}

	/**
	 * 修改用户状态
	 * @author 晚黎
	 * @date   2016-04-14T11:50:45+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function mark($id,$status)
	{
		$user = User::find($id);
		if ($user) {
			$user->status = $status;
			if ($user->save()) {
				Flash::success(trans('alerts.users.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.users.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 修改用户类型
	 * @author 晚黎
	 * @date   2016-04-14T11:50:45+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function changeUserType($id,$userData)
	{
		$user = BankeUserProfiles::find($id);
		if ($user) {
			$user['org_id'] = $userData['org_id_old'];
			$user['user_type'] = 4;
			if ($user->save()) {
				Flash::success(trans('alerts.users.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.users.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除角色
	 * @author 晚黎
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = User::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.users.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.users.deleted_error'));
		return false;
	}

	/**
	 * datatable获取数据
	 * @author shaolei
	 * @date   2016-04-13T21:14:37+0800
	 * @return [type]                   [description]
	 */
	public function ajaxOrgAccount()
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

		$user = new BankeUserProfiles;

		$user = $user->where('org_id', '>', 0);

		/*名称搜索*/
		if($name){
			if($search_pattern){
				$user = $user->where('name', 'like', $name);
			}else{
				$user = $user->where('name', $name);
			}
		}

		/*手机搜索*/
		if($mobile){
			if($search_pattern){
				$user = $user->where('mobile', 'like', $mobile);
			}else{
				$user = $user->where('mobile', $mobile);
			}
		}

		/*创建时间搜索*/
		if($created_at_from){
			$user = $user->where('created_at', '>=', getTime($created_at_from));
		}
		if($created_at_to){
			$user = $user->where('created_at', '<=', getTime($created_at_to, false));
		}

		/*修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
			$user = $user->where('created_at', '>=', getTime($updated_at_from));
		}
		if($updated_at_to){
			$user = $user->where('created_at', '<=', getTime($updated_at_to, false));
		}

		$count = $user->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$user = $user->orderBy($orderName, $orderDir);
		}

		$user = $user->offset($start)->limit($length);
		$users = $user->orderBy('uid','desc')->get();

		if ($users) {
			foreach ($users as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
				$v['org_name'] = '';
				if($v['org_id']) {
					$org = BankeOrg::find($v['org_id']);
					if ($org) {
						$v['org_name'] = $org->name;
					}
				}
			}
		}

		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $users,
		];
	}

	/*从已有app账户更新为机构账户*/
	public function store_org_account_old($request){
		$userData = $request->all();
		$mobile=$userData['mobile_old'];
		$user = new BankeUserProfiles;
		$user = $user->where('mobile',$mobile);
		if($user->count()>0) {
			return $this->changeUserType($user->first()['uid'], $userData);
		}
		return false;
	}

	//添加从新的账号，并设置为机构账号
	public function store_org_account_new($request){
		$userData = $request->all();
		$userData['user_type'] = 4;
		DB::transaction(function () use ($userData) {
			try{
				$uid=$this->insertBasicUserInfo($userData);
				$this->insertDetailUserInfo($uid,$userData);
			}
			catch (Exception $e){
				DB::rollBack();
				Log::info($e);
				Flash::error(trans('alerts.users.created_error'));
				return false;
			}
		});
	}

	/*用户基本信息创建*/
	public function insertBasicUserInfo($data){
		$user = [
			'name'=>$data['name'],
			'password'=>bcrypt($data['password']), //密码进行加密
			'mobile'=>$data['mobile_new'],
		];
		$newUser = User::create($user);
		return $newUser->id;
	}

	/*用户详细信息创建,自动更新用户资料关系*/
	public function insertDetailUserInfo($uid,$data){
		$code = Uuid::generate(4);
		$user_type=0;
		if($data['user_type']==4){
			$user_type=4;
		}
		$profiles = [
			'uid' => $uid,
			'name' => $data['name'],
			'mobile' => $data['mobile_new'],
			'org_id' => $data['org_id_new'],
			'user_type' => $user_type,
			'invitation_code' => $code
		];
		if(BankeUserProfiles::create($profiles)){
			Flash::success(trans('alerts.users.created_success'));
			return true;
		}
		return false;
	}


	/**
	 * 根据创建时间，得到 注册用户
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public static function getUserInLimitTime($startTime,$endTime=null,$authen=false)
	{
		$user = new BankeUserProfiles();
		$user = $user->where('created_at','>=',getTime($startTime));
		if($endTime){
			$user = $user->where('created_at','<',getTime($endTime));
		}
		if($authen){
			$user=$user->where('certification_status',2);
		}
		$user = $user ->get(['uid','name','created_at']);
		return $user;
	}


	/*
	 * 更新用户的余额信息,更新用户信息以及添加余额变动记录
	 * $type 情况分为4大种 ：任务(1) , 打卡(2) cms 中没有,提现（3），惩罚（4）
	 * $taskType 任务奖励包括：
	 * 1：认证奖励，注册奖励金额+20，账户总额 + 20；
	 * 2：邀请好友注册并认证，邀请人有奖励 +5 元
	 * 3: 邀请好友报名课程
	 * 4：评论机构、课程给予奖励
	 * 5：开团邀请好友阅读量达标奖励
	 *
		 * 'balance_log' => [
				['key'=>'WITHDRAW','desc' => '提现'],
				['key'=>'CHECK_IN_SUCCESS','desc' => '打卡奖励'],
				['key'=>'INVITE_FRIEND_ENROL_SUCCESS','desc' => '邀请报名成功奖励'],
				['key'=>'INVITE_FRIEND_REGISTER_AND_CERTIFICATE_SUCCESS','desc' => '邀请认证成功奖励'],
				['key'=>'REGISTER_AND_CERTIFICATE_SUCCESS','desc' => ' 注册并认证奖励'],
				['key'=>'REGISTER_SUCCESS','desc' => '注册奖励'],
				['key'=>'PUNISHMENT','desc' => '惩罚'],
				['key'=>'REFUND','desc' => '退款'],
				['key'=>'WITHDRAW_FAIL','desc' => '提现失败退回'],
				['key'=>'COMMENT','desc' => '评论奖励'], //v1.5之后区分 COMMENT_ORG COMMENT_COURSE
				['key'=>'COMMENT_ORG','desc' => '机构评论奖励'],
				['key'=>'COMMENT_COURSE','desc' => '课程心得奖励'],
				['key'=>'SHARE_GROUP_BUYING','desc' => '开团分享'],
				['key'=>'SHARE_SUCCESS','desc' => '分享奖励'],
				['key'=>'INVITE_FRIEND_BECOME_MARKETING_AMBASSADOR','desc' => '邀请好友成为推广大使奖励'],
			],
		 *
	 */
	public static function execUpdateUserAccountInfo($uid,$award,$type,$taskType){
		$user_profile = BankeUserProfiles::find($uid);//更新用户表
		$changeType='+';  //余额添加还是减
		$businessTypeIndex='-1';  //事务类型，下标对应 config->admin->balance_log 数组

		if($type==1){
			$user_profile->account_balance += $award;  //总余额 +
			switch($taskType){
				case 1://认证奖励，
					$user_profile->register_amount += $award;
					$user_profile->get_do_task_amount += $award;
					$businessTypeIndex=4;
					break;
				case 2: //邀请好友注册并认证
					$user_profile->invitation_amount+=$award;
					$user_profile->get_do_task_amount += $award;
					$businessTypeIndex=3;
					break;
				case 3:  //邀请好友报名课程
					$user_profile->get_do_task_amount += $award;
					$businessTypeIndex=2;
					break;
				case 4:  //机构评论
					$user_profile->get_do_task_amount += $award;
					$businessTypeIndex=10;
					break;
				case 5:  //课程心得
					$user_profile->get_do_task_amount += $award;
					$businessTypeIndex=11;
					break;
				case 6:  //开团分享
					$user_profile->get_do_task_amount += $award;
					$businessTypeIndex=12;
					break;
				case 7:  //邀请好友成为推广大使
					$user_profile->get_do_task_amount += $award;
					$businessTypeIndex=14;
					break;
				default:
					break;
			}
		}
		//提现
		else if($type==3){
			$user_profile->account_balance -= $award;  //总余额 +
			$user_profile->total_withdraw_amount += $award;  //总提现余额 +
			$user_profile->withdraw_amount = $award;  //当前提现余额 +
			$changeType='-';
			$businessTypeIndex=0;
		}

		//惩罚
		else if($type==4){
			//TODO 还在规划
		}

		$user_profile->save();


		//记录余额变动日志
		$cur_user = Auth::user();
		$operator_uid=0;//系统自动更新数据
		if($cur_user) {
			$operator_uid = $cur_user->id;
		}
		//事务类型
		$business_type=config('admin.global.balance_log')[$businessTypeIndex]['key'];
		$balance_log = [
			'uid'=>$uid,
			'change_amount'=>$award,
			'change_type'=>$changeType,
			'business_type'=>$business_type,
			'operator_uid'=>$operator_uid
		];
		//记录余额变动日志
		BankeBalanceLog::create($balance_log);
	}

	/**
	 * 根据创建时间，得到 注册半课APP用户 分组，每天多少人
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public static function getUserInLimitTimeByGroup($startTime,$endTime)
	{
		$user = new User;
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


}