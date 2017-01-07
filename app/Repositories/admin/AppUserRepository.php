<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeUserProfiles;
use App\Models\Banke\BankeUserAuthentication;
use Carbon\Carbon;
use Flash;
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
		if ($user) {
			$user->certification_status = $status;
			$user->certification_time = getTime();
			if ($user->save()) {
				//同步认证状态
				$user_profile = $user->profiles();
				$user_profile->certification_status = $status;
				$user_profile->certification_time = getTime();
				$user_profile->save();
				Flash::success(trans('alerts.users.certificate_success'));
				return true;
			}
			Flash::error(trans('alerts.users.certificate_error'));
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
}