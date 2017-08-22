<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeFreeStudy;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeFreeStudyUsers;
use Illuminate\Support\Facades\Log;

/**
* 免费学活动参与人员仓库
*/
class FreeStudyUsersRepository
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

		$status = request('status' ,'');

		$user = new BankeFreeStudyUsers;

		/*状态搜索*/
		if ($status!=null) {
			$user = $user->where('status', $status);
		}

		$count = $user->count();

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



	/**添加活动成员
	 * 	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$user = new BankeFreeStudyUsers;
		if ($user->fill($request->all())->save()) {
			Flash::success(trans('alerts.freestudy.created_success'));
			return $user->id;
		}
		Flash::error(trans('alerts.freestudy.created_error'));
		return false;
	}

	/**
	 * 修改活动
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$role = BankeFreeStudyUsers::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
		abort(404);
	}

	/**
	 * 查看活动
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$user = BankeFreeStudyUsers::find($id)->toArray();
		return $user;
	}

	/**
	 * 修改活动
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeFreeStudyUsers::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.freestudy.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.freestudy.updated_error'));
			return false;
		}
		abort(404);
	}


	/**
	 * 删除活动
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeFreeStudyUsers::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.freestudy.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.freestudy.deleted_error'));
		return false;
	}
}