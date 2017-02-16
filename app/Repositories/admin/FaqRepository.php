<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeFaq;
use App\User;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;

/**
* 常见问题仓库
*/
class FaqRepository
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

		$title = request('title' ,'');
		$status = request('status' ,'');

		$faq = new BankeFaq;

		/*配置名称搜索*/
		if($title){
			if($search_pattern){
				$faq = $faq->where('title', 'like', $title);
			}else{
				$faq = $faq->where('title', $title);
			}
		}
		/*状态搜索*/
		if ($status!=null) {
			$faq = $faq->where('status', $status);
		}

		$count = $faq->count();

		$faq = $faq->offset($start)->limit($length);
		$faqs = $faq->get();

		if ($faqs) {
			foreach ($faqs as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(true);
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $faqs,
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
		$isDelete = BankeFaq::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.faq.soft_deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.faq.soft_deleted_error'));
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

		$faq = BankeFaq::find($id)->toArray();
		return $faq;
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
		$role = BankeFaq::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
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
		$role = BankeFaq::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.faq.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.faq.updated_error'));
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
		$faq = new BankeFaq;
		if ($faq->fill($request->all())->save()) {
			Flash::success(trans('alerts.faq.created_success'));
			return true;
		}
		Flash::error(trans('alerts.faq.created_error'));
		return false;
	}

}