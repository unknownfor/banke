<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeBalanceLog;
use App\Models\Banke\BankeMessage;
use App\Models\Banke\BankeUserAuthentication;
use App\Models\Banke\BankeUserProfiles;
use App\Models\Banke\BankeWithdraw;
use Carbon\Carbon;
use App\User;
use Flash;
use DB;
use Auth;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
/**
* 提现仓库
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
		
		$status= request('status' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$mobile = request('mobile' ,'');
		$name = request('name' ,'');
		$orders = request('order', []);

		$withDraw = new BankeWithdraw;

		/*手机号搜索*/
		if($mobile){
			$user = BankeUserAuthentication::where('mobile',$mobile)->first();
			if($user['uid']!=null) {
				$withDraw = $withDraw->where('uid', $user['uid']);
			}
			else{
				$withDraw = $withDraw->where('uid','0ox3safwvd3gf');
			}
		}

		/*真实姓名搜索*/
		if ($name) {
			$user = BankeUserAuthentication::where('real_name',$name)->first();
			if($user['uid']!=null) {
				$withDraw = $withDraw->where('uid', $user['uid']);
			}else{
				$withDraw = $withDraw->where('uid','0');
			}
		}

		/*状态搜索*/
		if ($status!=null) {
			$withDraw = $withDraw->where('status', $status);
		}

		/*配置创建时间搜索*/
		if($created_at_from){
			$withDraw = $withDraw->where('created_at', '>=', getTime($created_at_from));
		}
		if($created_at_to){
			$withDraw = $withDraw->where('created_at', '<=', getTime($created_at_to, false));
		}

		/*配置修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
			$withDraw = $withDraw->where('created_at', '>=', getTime($updated_at_from));
		}
		if($updated_at_to){
			$withDraw = $withDraw->where('created_at', '<=', getTime($updated_at_to, false));
		}

		$count = $withDraw->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$withDraw = $withDraw->orderBy($orderName, $orderDir);
		}

		$withDraw = $withDraw->offset($start)->limit($length);
		$withDraws = $withDraw->orderBy("id", "desc")->get();

		if ($withDraws) {
			foreach ($withDraws as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
				$v['name'] = $v->userAuthen['real_name'];
				$v['mobile'] = $v->userAuthen['mobile'];
				$v['operator_name']='';
				if($v->operator) {
					$v['operator_name'] = $v->operator['name'];
				}
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $withDraws,
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
		$withDraw = new BankeWithdraw;
		if ($withDraw->fill($request->all())->save()) {
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
		$withDraw = BankeWithdraw::find($id);
		if ($withDraw) {
			$withDraw['name'] = $withDraw->userAuthen['real_name'];
			$withDraw['mobile'] = $withDraw->userAuthen['mobile'];
			$withDraw['account_balance'] = $withDraw->user['account_balance'];
			$operator_name='';
			$operator = new User;
			if($withDraw['operator_uid']!=""){
				$operator_name=$operator::find(($withDraw['operator_uid']))['name'];
			}
			$v['operator_name'] = $operator_name;
			$withDrawArray = $withDraw->toArray();
			return $withDrawArray;
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
		$input = $request->only(['status', 'processing_result']);
		$cur_user = Auth::user();
		$input['operator_uid'] = $cur_user['id'];
		$withDraw = BankeWithdraw::find($id);
		if ($withDraw) {
			if ($withDraw->fill($input)->save()) {
				if($input['status'] == config('admin.global.status.ban')){
					DB::beginTransaction();
					try {
						$user_profile = BankeUserProfiles::where('uid', $withDraw['uid'])->lockForUpdate()->first();
						$user_profile->account_balance += $withDraw['withdraw_amount'];
                                                $user_profile->total_withdraw_amount-=$withDraw['withdraw_amount'];
						$user_profile->save();

						$balance_log = [
							'uid'=>$withDraw['uid'],
							'change_amount'=>$withDraw['withdraw_amount'],
							'change_type'=>'+',
							'business_type'=>'WITHDRAW_FAIL',
							'operator_uid'=>$cur_user['id'],
							'withdraw_id'=>$id
						];
						//记录余额变动日志
						BankeBalanceLog::create($balance_log);

						$message1 = [
							'uid'=>$withDraw['uid'],
							'title'=>'提现失败',
							'content'=>'您于'.$withDraw['created_at'].'发起的'.$withDraw['withdraw_amount'].'元提现失败！
							'.$input['processing_result'],
							'type'=>'WITHDRAW_FAIL'
						];
						//记录消息
						BankeMessage::create($message1);

						DB::commit();
						Flash::success(trans('alerts.withdraw.updated_success'));
						return true;
					} catch (Exception $e) {
						DB::rollback();
						Log::info($e);
						Flash::error(trans('alerts.withdraw.updated_error'));
						return false;
					}
				}
				elseif($input['status'] == config('admin.global.status.active')){
					$message1 = [
						'uid'=>$withDraw['uid'],
						'title'=>'提现成功',
						'content'=>'您于'.$withDraw['created_at'].'发起的'.$withDraw['withdraw_amount'].'元提现已成功！',
						'type'=>'WITHDRAW_SUCCESS'
					];
					//记录消息
					BankeMessage::create($message1);
					Flash::success(trans('alerts.withdraw.updated_success'));

					return true;
				}
			}else{
				Flash::error(trans('alerts.withdraw.updated_error'));
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
		$withDraw = BankeWithdraw::find($id);
		if ($withDraw) {
			$withDraw->status = $status;
			if ($withDraw->save()) {
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