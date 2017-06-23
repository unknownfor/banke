<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeOrderDeposit;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeMessage;
use App\Models\Banke\BankeUserAuthentication;
use App\Models\Banke\BankeUserProfiles;
use Carbon\Carbon;
use Flash;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;

/**
* 订单（报名）仓库 订金
*/
class OrderDepositRepository
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

		$search_pattern = true;

		$mobile = request('mobile' ,'');
		$pay_status = request('pay_status' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');

		$deposit = new BankeOrderDeposit;

		/*手机号搜索*/
		if($mobile){
			if($search_pattern){
				$deposit = $deposit->where('mobile', 'like', $mobile);
			}else{
				$deposit = $deposit->where('mobile', $mobile);
			}
		}
		/*状态搜索*/
		if ($pay_status!=null) {
			$deposit = $deposit->where('pay_status', $pay_status);
		}

		/*配置创建时间搜索*/
		if($created_at_from){
			$deposit = $deposit->where('created_at', '>=', getTime($created_at_from));
		}
		if($created_at_to){
			$deposit = $deposit->where('created_at', '<=', getTime($created_at_to, false));
		}

		$count = $deposit->count();

		$deposit = $deposit->offset($start)->limit($length);
		$deposits = $deposit->orderBy("id", "desc")->get();

		if ($deposits) {
			foreach ($deposits as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(true);
				$v['name']  =$v->authenUser['real_name'];
				if(!$v['name']){
					$v['name'] = $v->user['name'];
				}
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $deposits,
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
		$isDelete = BankeOrderDeposit::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.orderdeposit.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.orderdeposit.deleted_error'));
		return false;
	}


	/**
	 * 修改
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$order = BankeOrderDeposit::find($id);
		$order['name']  =$order->authenUser['real_name'];
		if(!$order['name']){
			$order['name'] = $order->user['name'];
		}
		if ($order) {
			$orderArray = $order->toArray();
			return $orderArray;
		}
		abort(404);
	}

	/**
	 * 更新
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeOrderDeposit::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.orderdeposit.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.orderdeposit.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 修改配置视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$order = BankeOrderDeposit::find($id)->toArray();
		return $order;
	}



	/**
	 * 通过课程id,用户id，得到订金
	 * @author jimmy
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public static function getDepositByCouseIdAndUid($course_id,$uid)
	{
		$order = BankeCashBackUser::where(['course_id'=>$course_id,'uid'=>$uid,'status'=>1])->first();
		return $order;
	}

	/**
	 * 根据机构id得到订单的数量
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public static function getOrderInfoByOrgId($oid)
	{
		$allOrders=BankeOrderDeposit::where(['org_id'=>$oid,'pay_status'=>1]);
		$totalAccount=0;
		foreach($allOrders as $v){
			$totalAccount +=$v->account;
		}
		return ['counts'=>$allOrders->count(),'account'=>$totalAccount];
	}
}