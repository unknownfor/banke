<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeFreeStudy;
use Illuminate\Support\Facades\Log;

/**
* 免费学活动仓库
*/
class FreeStudyRepository
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

		$freestudy = new BankeFreeStudy;

		/*状态搜索*/
		if ($status!=null) {
			$freestudy = $freestudy->where('status', $status);
		}

		$count = $freestudy->count();

		$freestudy = $freestudy->offset($start)->limit($length);
		$freestudys = $freestudy->orderBy("sort","desc")->orderBy("id", "desc")->get();

		if ($freestudys) {
			foreach ($freestudys as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $freestudys,
		];
	}



	/**添加活动
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$freestudy = new BankeFreeStudy;
		if ($freestudy->fill($request->all())->save()) {
			Flash::success(trans('alerts.freestudy.created_success'));
			return $freestudy->id;
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
		$role = BankeFreeStudy::find($id);
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
		$freestudy = BankeFreeStudy::find($id)->toArray();
		return $freestudy;
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
		$role = BankeFreeStudy::find($id);
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
		$isDelete = BankeFreeStudy::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.freestudy.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.freestudy.deleted_error'));
		return false;
	}
}