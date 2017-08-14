<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeCashBackUser;
use App\Models\Banke\BankeInvitationSignUp;
use App\Models\Banke\BankeOrg;
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
* 邀请报名仓库
*/
class InvitationSignUpRepository
{

	/**添加常见问题
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$invitation = new BankeInvitationSignUp;
		if ($invitation->fill($request)->save()) {
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
