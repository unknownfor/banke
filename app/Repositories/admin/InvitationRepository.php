<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeFeedback;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;

/**
* 邀请仓库
*/
class InvitaionRepository
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
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$feedback = new BankeFeedback;

		/*配置名称搜索*/
		if($name){
			if($search_pattern){
				$feedback = $feedback->where('name', 'like', $name);
			}else{
				$feedback = $feedback->where('name', $name);
			}
		}


		/*配置创建时间搜索*/
		if($created_at_from){
			$feedback = $feedback->where('created_at', '>=', getTime($created_at_from));
		}
		if($created_at_to){
			$feedback = $feedback->where('created_at', '<=', getTime($created_at_to, false));
		}


		$count = $feedback->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$feedback = $feedback->orderBy($orderName, $orderDir);
		}

		$feedback = $feedback->offset($start)->limit($length);
		$feedbacks = $feedback->get();

		if ($feedbacks) {
			foreach ($feedbacks as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $feedbacks,
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
		$isDelete = BankeCashBackUser::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.feedback.soft_deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.feedback.soft_deleted_error'));
		return false;
	}

}