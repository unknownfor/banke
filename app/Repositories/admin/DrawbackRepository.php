<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeCashBackUser;
use App\Models\Banke\BankeUserAuthentication;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeDrawback;
use App\User;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;

/**
* 机构返款仓库
*/
class DrawbackRepository
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


		$student_mobile = request('student_mobile' ,'');
		$status = request('status' ,'');

		$drawback = new BankeDrawback();

		/*配置名称搜索*/
		if($student_mobile){
			$drawback = $drawback->where('student_mobile', $student_mobile);
		}
		/*状态搜索*/
		if ($status!=null) {
			$drawback = $drawback->where('status', $status);
		}

		$count = $drawback->count();

		$drawback = $drawback->offset($start)->limit($length);
		$drawbacks = $drawback->orderBy("id", "desc")->get();

		if ($drawbacks) {
			foreach ($drawbacks as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(true);
				$order = new BankeCashBackUser();
				$v['course_name'] = $order::where('order_id',$v['order_id'])->first()['course_name'];

//				操作人
				$operator_name='';
				$operator = new User;
				if($v['operator_id']!=""){
					$operator_name=$operator::find(($v['operator_id']))['name'];
				}
				$v['operator_name'] = $operator_name;
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $drawbacks,
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
		$isDelete = BankeDrawback::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.drawback.soft_deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.drawback.soft_deleted_error'));
		return false;
	}

	/**
	 * 查看常见问题信息
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{

		$drawback = BankeDrawback::find($id)->toArray();
		$order = new BankeCashBackUser();
		$drawback['course_name'] = $order::where('order_id',$drawback['order_id'])->first()['course_name'];
		$user=BankeUserAuthentication::where('mobile',$drawback['student_mobile']);
		$user=$user->first();
		$drawback['student_name'] = $user['real_name'];
		return $drawback;
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
		$drawback = BankeDrawback::find($id)->toArray();
		$order = new BankeCashBackUser();
		$drawback['course_name'] = $order::where('order_id',$drawback['order_id'])->first()['course_name'];
		$user=BankeUserAuthentication::where('mobile',$drawback['student_mobile']);
		$user=$user->first();
		$drawback['student_name'] = $user['real_name'];
		return $drawback;

		abort(404);
	}

	/**
	 * 修改问题
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$drawback = BankeDrawback::find($id);
		if ($drawback) {
			if ($drawback->fill($request->all())->save()) {
  				//TODO 放着先不做

				$input = $request->only(['comment', 'status','account']);
				//确定订单退款
				if ($input['status'] == config('admin.global.status.active')) {

					DB::transaction(function () use ($input,$drawback) {
						try {
							$cur_user = Auth::user();
							$input['operator_uid'] = $cur_user->id;

							//退单信息更新
							$drawback->fill($input->all())->save();

							//更新订单的状态
							$order_id=$drawback['order_id'];
							$order = BankeCashBackUser::where('order_id',$order_id)->lockForUpdate()->first();
							$order->statu=2;  //标识为退款款
							$order->save();

							//更新用户的待返金额状态，将 打卡可奖励 金额去除相应的数值，任务可返金额也去除相应数字
							$userProfile = BankeUserProfiles::where('uid', $order->uid)->lockForUpdate()->first();
							$userProfile->check_in_amount -= $input['account'];
							$userProfile->do_task_amount += $role['do_task_amount'];
							$userProfile->total_cashback_amount += ($role['check_in_amount'] + $role['do_task_amount']);
							$userProfile->period += $role->period;
							//更新报名学生的信息
							$userProfile->save();

						} catch (Exception $e) {
							Log::info($e);
							Flash::error(trans('alerts.order.created_error'));
							return false;

						}
					});
					Flash::success(trans('alerts.drawback.updated_success'));
					return true;
				}
			}
			Flash::error(trans('alerts.drawback.updated_error'));
			return false;
		}
		abort(404);
	}


	/**添加问题
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$drawback = new BankeDrawback;
		$cur_user = Auth::user();
		$drawback['operator_id'] = $cur_user['id'];
		if ($drawback->fill($request->all())->save()) {
			Flash::success(trans('alerts.drawback.created_success'));
			return true;
		}
		Flash::error(trans('alerts.drawback.created_error'));
		return false;
	}

}