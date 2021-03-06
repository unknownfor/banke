<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeAlertBox;
use Carbon\Carbon;
use Flash;
/**
* 弹出框仓库
*/
class AlertBoxRepository
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

		$type = request('user_type' ,'');
		$status = request('status' ,'');
		$strategy = new BankeAlertBox;


		/*状态搜索*/
		if ($status !=null ) {
			$strategy = $strategy->where('status', $status);
		}

		/*用户类型搜索*/
		if ($type !=null) {
			$strategy = $strategy->where('user_type', $type);
		}

		$count = $strategy->count();


		$strategy = $strategy->offset($start)->limit($length);
		$strategy = $strategy->orderBy("id", "desc")->get();
               

		if ($strategy) {
			foreach ($strategy as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
			}
		}
               
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $strategy,
		];
	}

	/**
	 * 添加弹出提示
	 * @author shaolei
	 * @date   2016-04-13T11:50:22+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{   
		$strategy = new BankeAlertBox;
		if ($strategy->fill($request->all())->save()) {
			Flash::success(trans('alerts.alertbox.created_success'));
			return true;
		}
		Flash::error(trans('alerts.alertbox.created_error'));
		return false;
	}
	/**
	 * 修改弹出提示视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$strategy = BankeAlertBox::find($id);
		if ($strategy) {
			$strategyArray = $strategy->toArray();
			return $strategyArray;
		}
		abort(404);
	}
	/**
	 * 修改弹出提示
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$strategy = BankeAlertBox::find($id);
		if ($strategy) {
			if ($strategy->fill($request->all())->save()) {
				Flash::success(trans('alerts.alertbox.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.alertbox.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 修改弹出提示状态
	 * @author shaolei
	 * @date   2016-04-13T11:51:02+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function mark($id,$status)
	{
		$strategy = BankeAlertBox::find($id);
		if ($strategy) {
			$strategy->status = $status;
			if ($strategy->save()) {
				Flash::success(trans('alerts.alertbox.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.alertbox.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除弹出提示
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeAlertBox::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.alertbox.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.alertbox.deleted_error'));
		return false;
	}

}