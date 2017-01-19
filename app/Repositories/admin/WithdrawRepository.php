<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeBalanceLog;
use App\Models\Banke\BankeCheckIn;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeDict;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeUserProfiles;
use App\Models\Banke\BankeWithdraw;
use Carbon\Carbon;
use Flash;
use DB;
use Auth;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
/**
* 权限仓库
*/
class WithdrawRepository
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

		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/
		
		$name = request('name' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$role = new BankeWithdraw;

		/*配置名称搜索*/
/*		if($name){
			if($search_pattern){
				$role = $role->where('key', 'like', $name);
			}else{
				$role = $role->where('key', $name);
			}
		}*/

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
		$roles = $role->get();

		if ($roles) {
			foreach ($roles as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
				$user = BankeUserProfiles::find($v['uid']);
				$v['name'] = $user['name'];
				$v['mobile'] = $user['mobile'];
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
		$role = new BankeWithdraw;
		if ($role->fill($request->all())->save()) {
			Flash::success(trans('alerts.checkin.created_success'));
			return true;
		}
		Flash::error(trans('alerts.checkin.created_error'));
		return false;
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
		$role = BankeWithdraw::find($id);
		if ($role) {
			$user = BankeUserProfiles::find($role['uid']);
			$role['name'] = $user['name'];
			$role['mobile'] = $user['mobile'];
			$org = BankeOrg::find($role['org_id']);
			$role['org_name'] = $org['name'];
			$course = BankeCourse::find($role['course_id']);
			$role['course_name'] = $course['name'];
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
		$input = $request->only(['status', 'comment']);
		$role = BankeWithdraw::find($id);
		if ($role) {
			if ($role->fill($input)->save()) {
				if($input['status'] == config('admin.global.status.ban')){
					DB::beginTransaction();
					try {
						$user_profile = BankeUserProfiles::where('uid', $role['uid'])->lockForUpdate()->first();
						$user_profile->account_balance -= $role['award_amount'];
						$user_profile->save();

						$cur_user = Auth::user();
						$balance_log = [
							'uid'=>$role['uid'],
							'change_amount'=>$role['award_amount'],
							'change_type'=>'-',
							'business_type'=>'PUNISHMENT',
							'operator_uid'=>$cur_user['id']
						];
						//记录余额变动日志
						BankeBalanceLog::create($balance_log);
						DB::commit();
						Flash::success(trans('alerts.checkin.updated_success'));
						return true;
					} catch (Exception $e) {
						DB::rollback();
						Log::info($e);
						Flash::error(trans('alerts.checkin.updated_error'));
						return false;
					}
				}
				Flash::success(trans('alerts.checkin.updated_success'));
				return true;
			}else{
				Flash::error(trans('alerts.checkin.updated_error'));
				return false;
			}
		}else{
			abort(404);
		}
	}

	/**
	 * 修改配置状态
	 * @author shaolei
	 * @date   2016-04-13T11:51:02+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function mark($id,$status)
	{
		$role = BankeWithdraw::find($id);
		if ($role) {
			$role->status = $status;
			if ($role->save()) {
				Flash::success(trans('alerts.checkin.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.checkin.updated_error'));
			return false;
		}
		abort(404);
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
		$isDelete = BankeWithdraw::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.checkin.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.checkin.deleted_error'));
		return false;
	}

}