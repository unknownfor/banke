<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeGroupbuyingWords;
use Carbon\Carbon;
use Flash;
/**
* 新闻仓库
*/
class GroupbuyingWordsRepository
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
		
		$name = request('title' ,'');
		$status = request('status' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);
		$role = new BankeGroupBuyingWords;

		/*配置名称搜索*/
		if($name){
			if($search_pattern){
				$role = $role->where('title', 'like', $name);
			}else{
				$role = $role->where('title', $name);
			}
		}

		/*状态搜索*/
		if ($status) {
			$role = $role->where('status', $status);
		}

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
		$roles = $role->orderBy("id", "desc")->get();
               

		if ($roles) {
			foreach ($roles as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
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
		$role = new BankeGroupbuyingWords;
		if ($role->fill($request->all())->save()) {
			Flash::success(trans('alerts.groupbuyingwords.created_success'));
			return true;
		}
		Flash::error(trans('alerts.groupbuyingwords.created_error'));
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
		$role = BankeGroupbuyingWords::find($id);
		if ($role) {
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
		$role = BankeGroupbuyingWords::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.groupbuyingwords.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.groupbuyingwords.updated_error'));
			return false;
		}
		abort(404);
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
		$role = BankeGroupbuyingWords::find($id);
		if ($role) {
			$role->status = $status;
			if ($role->save()) {
				Flash::success(trans('alerts.groupbuyingwords.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.groupbuyingwords.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除配置
	 * @author jimmy
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeGroupbuyingWords::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.groupbuyingwords.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.groupbuyingwords.deleted_error'));
		return false;
	}

	/**
	 * 获取随机的一条记录
	 * @author jimmy
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public static function getRandomRecord()
	{
		$groupbuying = new BankeGroupbuyingWords;
		$groupbuying = $groupbuying::where('status',1);
		$counts = $groupbuying->count();
		if($counts>0) {
			$start = rand(0, $counts-1);
			$words = $groupbuying->offset($start)->limit(1)->first();
			return $words;
		}
		return null;
	}
}