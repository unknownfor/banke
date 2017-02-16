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
* 反馈内容仓库
*/
class FeedbackRepository
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
				$v['actionButton'] = $v->getActionButtonAttribute(true);
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
	 * 查看反馈信息
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$feedback = BankeFeedback::find($id)->toArray();
		return $feedback;
	}

	/**
	 * 修改反馈信息
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$feedback = BankeFeedback::find($id);
		if ($feedback) {
			$roleArray = $feedback->toArray();
			return $roleArray;
		}
		abort(404);
	}

	/**
	 * 修改反馈信息
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeFeedback::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.feedback.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.feedback.updated_error'));
			return false;
		}
		abort(404);
	}

}