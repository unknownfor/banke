<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeDict;
use App\Models\Banke\BankeInvitation;
use App\Models\Banke\BankeUserAuthentication;
use App\Models\Banke\BankeUserProfiles;
use App\Models\Banke\BankeTask;
use App\User;
use Carbon\Carbon;
use Flash;
use Mockery\CountValidator\Exception;
use DB;
use Auth;
use RecruiteTeacherRepository;
use AppUserRepository;

/**
* 用户仓库
*/
class UserRepository
{
	/**
	 * datatable获取数据
	 * @author 晚黎
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
		$email = request('email' ,'');
		$confirm_email = request('confirm_email' ,'');
		$status = request('status' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$user = new User;
		$user = $user->where('email', '!=', '');

		/*名称搜索*/
		if($name){
			if($search_pattern){
				$user = $user->where('name', 'like', $name);
			}else{
				$user = $user->where('name', $name);
			}
		}

		/*邮箱搜索*/
		if($email){
			if($search_pattern){
				$user = $user->where('email', 'like', $email);
			}else{
				$user = $user->where('email', $email);
			}
		}
		/*验证邮箱搜索*/
		if($confirm_email){
			if($search_pattern){
				$user = $user->where('confirm_email', 'like', $confirm_email);
			}else{
				$user = $user->where('confirm_email', $confirm_email);
			}
		}
		
		/*状态搜索*/
		if ($status) {
			$user = $user->where('status', $status);
		}

		/*权限创建时间搜索*/
		if($created_at_from){
			$user = $user->where('created_at', '>=', getTime($created_at_from));	
		}
		if($created_at_to){
			$user = $user->where('created_at', '<=', getTime($created_at_to, false));	
		}

		/*权限修改时间搜索*/
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
		$users = $user->orderBy("id", "desc")->get();

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
	 * 添加用户
	 * @author 晚黎
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$user = new User;

		$userData = $request->all();
		//密码进行加密
		$userData['password'] = bcrypt($userData['password']);

		if ($user->fill($userData)->save()) {
			//自动更新用户权限关系
			if ($userData['permission']) {
				$user->permission()->sync($userData['permission']);
			}
			// 自动更新用户角色关系
			if ($userData['role']) {
				$user->role()->sync($userData['role']);
			}
			Flash::success(trans('alerts.users.created_success'));
			return true;
		}
		Flash::error(trans('alerts.users.created_error'));
		return false;
	}
	/**
	 * 修改用户视图
	 * @author 晚黎
	 * @date   2016-04-14T15:02:10+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$user = User::with(['permission','role'])->find($id);
		if ($user) {
			$userArray = $user->toArray();
			if ($userArray['permission']) {
				$userArray['permission'] = array_column($userArray['permission'],'id');
			}
			if ($userArray['role']) {
				$userArray['role'] = array_column($userArray['role'],'id');
			}
			return $userArray;
		}
		abort(404);
	}
	/**
	 * 修改用户资料
	 * @author 晚黎
	 * @date   2016-04-14T15:17:25+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$user = User::find($id);
		if ($user) {
			if ($user->fill($request->all())->save()) {
				//自动更新用户权限关系
				if ($request->permission) {
					$user->permission()->sync($request->permission);
				}
				//自动更新用户角色关系
				if ($request->role) {
					$user->role()->sync($request->role);
				}
				Flash::success(trans('alerts.users.updated_success'));

				return true;
			}

			Flash::error(trans('alerts.users.updated_error'));
			return false;
		}
		abort(404);
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
	 * 查看角色权限
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{

		$user = User::with(['permission','role'])->findOrFail($id)->toArray();

		if ($user['permission']) {
			$permissionArray = [];
			foreach ($user['permission'] as $v) {
				array_set($permissionArray, $v['slug'], ['name' => $v['name'],'desc' => $v['description']]);
			}
			$user['permission'] = $permissionArray;
		}
		return $user;
	}

	public function resetPassword($request)
	{
		$request = $request->all();
		$request['password'] = bcrypt($request['password']);
		$user = User::find($request['id']);
		if ($user) {
			if ($user->fill($request)->save()) {
				Flash::success(trans('alerts.users.reset_success'));
				return true;
			}
			Flash::error(trans('alerts.users.reset_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 修改管理员资料
	 */
	public function changeAdminInfoById($request)
	{
		$request = $request->all();
		$user = User::find($request['id']);
		if ($user) {
			if ($user->fill($request)->save()) {
				Flash::success(trans('alerts.users.admin_info_success'));
				return true;
			}
			Flash::error(trans('alerts.users.admin_info_fail'));
			return false;
		}
		abort(404);
	}

	/**
	 * 获取用户信息by email
	 * @param $email
	 */
	public function getUserInfoByEmail($email)
	{
		$user_info = User::where("email",$email)->get();
		return $user_info;
	}

	public function getUserInfoById($id)
	{
		$user_info = User::find($id);
		return $user_info;
	}

	public function search_by_mobile()
	{
		$mobile = request('mobile', '');
		$user_info =new BankeUserProfiles;
		$user_info = $user_info->where('mobile',$mobile);
		$user_info=$user_info->get(['uid', 'name', 'mobile','org_id']);
		if ($user_info) {
			foreach ($user_info as &$v) {
				$real_name=$v->authentication['real_name'];
				if($real_name) {
					$v['name'] =$real_name;
				}
			}
		}
		return $user_info;
	}

	/*
	 * 通过uid获得用户的姓名、头、手机号
	 * 如果是已经认证，则返回真实姓名，真实
	 * 否则返回昵称
	 * */
	public  static  function getUserSimpleInfoById($uid){
		$user_info =new BankeUserProfiles;
		$user_info = $user_info::find($uid);
		if($user_info) {
			$name = $user_info->authentication['real_name'];
			if ($name) {
				$user_info['name']=$name;
			}
			if(!$user_info['avatar']){

				$user_info['avatar']=BankeDict::find(14)['value'];
			}
		}
		return $user_info;
	}

	/*
	 * 通过mobile得用户的姓名、头、手机号
	 * 如果是已经认证，则返回真实姓名，真实
	 * 否则返回昵称
	 * */
	public  static  function getUserSimpleInfoByMobile($mobile){
		$user_info =new BankeUserProfiles;
		$user_info = $user_info::where('mobile',$mobile);
		if($user_info->count()>0) {
			$user_info=$user_info->first();
			if ($user_info->uid) {
				;
				$name = $user_info->authentication['real_name'];
				if ($name) {
					$user_info['name'] = $name;
				}
				if (!$user_info['avatar']) {
					$user_info['avatar'] = BankeDict::find(14)['value'];
				}
			}
			return $user_info;
		}else{
			return null;
		}
	}

	/**
	 * 注册半课APP用户
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function register($userData)
	{
		$user = new User;
		//注册用户生成用户名
		$userData['name'] = createUserName($userData['mobile']);
		//密码进行加密
		
		$userData['password'] = bcrypt($userData['password']);
		$result=false;

		DB::transaction(function () use ($user,$userData,$result) {
			try {
				$user->fill($userData)->save();

				$invitation_user = BankeUserProfiles::where('invitation_code', $userData['welcome'])->first();
				$invitation_user->invitation_count += 1;
				$invitation_user->save();
				$invitation_uid=$invitation_user['uid'];
				// 自动更新用户资料关系
				$profiles = [
					'uid' => $user->id,
					'name' => $userData['name'],
					'mobile'=> $userData['mobile'],
					'invitation_uid'=>$invitation_uid,
					'invitation_code'=> $this->create_uuid()
				];
				$user->profiles()->create($profiles);

				// 自动更新用户资料关系
				$authentication = [
					'uid' => $user->id,
					'mobile'=> $userData['mobile']
				];
				$user->authentication()->create($authentication);

				//奖励用户8.8
				$this->awardToUser($user->id);

				//v1.8  禁止重复邀请
				$invitationInfo=BankeInvitation::where('target_mobile',$userData['mobile']);
				if($invitationInfo->count()==0) {

					//记录邀请信息
					$invitation_log = [
						'uid' => $invitation_uid,
						'name' => $invitation_user['name'],
						'mobile' => $invitation_user['mobile'],
						'target_mobile' => $userData['mobile']
					];
					BankeInvitation::create($invitation_log);
				}

				//v1.7添加招生老师注册
				if($userData['userType']==3) {
					$userData['invitation_uid'] = $invitation_uid;
					RecruiteTeacherRepository::register($userData);
				}


				DB::commit();
				Flash::success(trans('alerts.users.created_success'));
				$result = true;
			} catch (Exception $e) {
				DB::rollBack();
				Log::info($e);
				Flash::error(trans('alerts.users.created_error'));
				$result = false;
			}
			return $result;

		});
		return true;
	}

	/*用户领取注册红包*/
	private function awardToUser($uid){
		$bankeTask=new BankeTask;
		//获取注册奖励金
		$TaskRegister=$bankeTask->where('type',11)->first();
		if(!empty($TaskRegister['award_coin'])){
			$award=$TaskRegister['award_coin'];
			// 将领取金额累加到用户账户余额中去
			DB::beginTransaction ();
			try {
				AppUserRepository::execUpdateUserAccountInfo($uid,$award,1,9);
				// 记录massge表系统消息
				$message = [
					'status' => 0,
					'uid' => $uid,
					'title' => '签到奖励',
					'content' => '恭喜您注册半课账号，获得半课学习奖励'.$award.'元，还有更多奖励戳我',
					'type' => 'REGISTER_SUCCESS'
				];
				// 记录消息
				BankeMessage::create($message);
				DB::commit ();
				return true;
			} catch ( Exception $e ) {
				DB::rollback ();
				return false;
			}
		}
	}

	private function create_uuid($prefix = ""){    //可以指定前缀
		$str = md5(uniqid(mt_rand(), true));
		$uuid  = substr($str,0,8) . '-';
		$uuid .= substr($str,8,4) . '-';
		$uuid .= substr($str,12,4) . '-';
		$uuid .= substr($str,16,4) . '-';
		$uuid .= substr($str,20,12);
		return $prefix . $uuid;
	}

	/*根据账号密码登录  老师账号*/
	public static function loginByMobileAndPwdOrg($userData)
	{
		$mobile = $userData['mobile'];
		$pwd = $userData['password'];
		if (Auth::attempt(['mobile' => $mobile, 'password' => $pwd], 1)) {
			$userInfo=BankeUserProfiles::where(['mobile'=>$mobile]);
			if($userInfo->count()>0) {
				$userInfo=$userInfo->first();
				return $userInfo['org_id'];
			}
		}
		return 0;
	}
}