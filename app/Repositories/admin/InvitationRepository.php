<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeInvitation;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeUserAuthentication;
use App\Models\Banke\BankeEnrol;
use App\User;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;

/**
* 邀请仓库
*/
class InvitationRepository
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
		$target_mobile= request('target_mobile' ,'');

		$invitation = new BankeInvitation;

		/*配置名称搜索*/
		if($name){
			if($search_pattern){
				$invitation = $invitation->where('name', 'like', $name);
			}else{
				$invitation = $invitation->where('name', $name);
			}
		}
		if($mobile){
			if($search_pattern){
				$invitation = $invitation->where('mobile', 'like', $mobile);
			}else{
				$invitation = $invitation->where('mobile', $mobile);
			}
		}
		if($target_mobile){
			if($search_pattern){
				$invitation = $invitation->where('target_mobile', 'like', $target_mobile);
			}else{
				$invitation = $invitation->where('target_mobile', $target_mobile);
			}
		}


		$count = $invitation->count();


		$invitation = $invitation->offset($start)->limit($length);
		$invitations = $invitation->get();

		if ($invitations) {
			$authentication = new BankeUserAuthentication;
			$enrol = new BankeEnrol;
			$user = new User;
			foreach ($invitations as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
				//认证状态
				$authen = $authentication->find($v['uid']);
				$isAuthen=0;
				if($authen && $authen->count()>0){
					$isAuthen=1;
					$v['name']=$authen['real_name'];
				}
				$v['authentivation_status'] = $isAuthen;


				//报名状态
				$en = $enrol->where('mobile', $v['target_mobile']);
				$v['order_status'] = 0;
				if($en->count()>0) {
					$v['order_status'] = 1;
				}
				//注册日期
				$userInfo = $user->find($v['uid']);
				if($userInfo) {
					$v['register_at']=$userInfo['created_at'];
				}
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $invitations,
		];
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
		$isDelete = BankeInvitation::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.invitation.soft_deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.invitation.soft_deleted_error'));
		return false;
	}

	/**添加常见问题
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$role = new BankeOrg;
		if ($role->fill($request->all())->save()) {
			Flash::success(trans('alerts.org.created_success'));
			return true;
		}
		Flash::error(trans('alerts.org.created_error'));
		return false;
	}

	/**
	 * 修改常见问题视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$role = BankeOrg::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
		abort(404);
	}

	/**
	 * 查看常见问题
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$org = BankeOrg::find($id)->toArray();
		return $org;
	}

	/**
	 * 修改常见问题
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeOrg::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.org.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.org.updated_error'));
			return false;
		}
		abort(404);
	}

}