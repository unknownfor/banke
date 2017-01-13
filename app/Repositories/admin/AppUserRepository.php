<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeUserProfiles;
use App\Models\Banke\BankeUserAuthentication;
use App\Models\Banke\BankeDict;
use App\User;
use Carbon\Carbon;
use Flash;
use DB;
use Auth;
use Illuminate\Support\Facades\Log;

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
		$users = $user->get();

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
		$users = $user->get();

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
					if($status == config('admin.global.certification_status.active')){
						//查询系统配置里注册认证的奖金
						$register_award = BankeDict::where('id', 1)->first();
						$user_profile->account_balance += $register_award->value;
						$user_profile->register_amount += $register_award->value;

						if($user_profile->invitation_uid > 0){
							$invitation_user = BankeUserProfiles::where('uid', $user_profile->invitation_uid)->lockForUpdate()->first();
							//查询系统配置里邀请人注册认证的奖金
							$invitation_award = BankeDict::where('id', 2)->first();
							$invitation_user->invitation_amount += $invitation_award->value;
							$invitation_user->account_balance += $invitation_award->value;
							$invitation_user->save();
						}
					}
					//同步认证状态
					$user_profile->save();
					Flash::success(trans('alerts.app_user.certificate_success'));
					return true;
				} catch (Exception $e) {
					Flash::error(trans('alerts.app_user.certificate_error'));
					var_dump($e);
					return false;
				}
			});
		}else{
			abort(404);
		}
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
		$users = $user->get();

		if ($users) {
			foreach ($users as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
				$org = BankeOrg::find($v['org_id']);
				$v['org_name'] = $org->name;
			}
		}

		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $users,
		];
	}

	public function store_org_account($request){
		$user = new User;
		$userData = $request->all();
		$userData['status'] = 1;
		//密码进行加密
		$userData['password'] = bcrypt($userData['password']);
		if ($user->fill($userData)->save()) {
			// 自动更新用户资料关系
			$profiles = [
				'uid' => $user->id,
				'name' => $userData['name'],
				'mobile'=> $userData['mobile'],
				'org_id' => $userData['org_id']
			];
			$user->profiles()->create($profiles);
			Flash::success(trans('alerts.users.created_success'));
			return true;
		}
		Flash::error(trans('alerts.users.created_error'));
		return false;
	}
}