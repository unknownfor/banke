<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeOrgRebates;
use App\User;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;

/**
* 机构返款仓库
*/
class OrgRebatesRepository
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

		$rebates = new BankeOrgRebates();

		/*配置名称搜索*/
		if($title){
			if($search_pattern){
				$rebates = $rebates->where('title', 'like', $title);
			}else{
				$rebates = $rebates->where('title', $title);
			}
		}
		/*状态搜索*/
		if ($status!=null) {
			$rebates = $rebates->where('status', $status);
		}

		$count = $rebates->count();

		$rebates = $rebates->offset($start)->limit($length);
		$rebatess = $rebates->get();

		if ($rebatess) {
			foreach ($rebatess as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(true);
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $rebatess,
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
		$isDelete = BankeOrgRebates::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.rebates.soft_deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.rebates.soft_deleted_error'));
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

		$rebates = BankeOrgRebates::find($id)->toArray();
		return $rebates;
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
		$rebates = BankeOrgRebates::find($id);
		if ($rebates) {
			$rebatesArray = $rebates->toArray();
			return $rebatesArray;
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
		$rebates = BankeOrgRebates::find($id);
		if ($rebates) {
			if ($rebates->fill($request->all())->save()) {
				Flash::success(trans('alerts.rebates.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.rebates.updated_error'));
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
		$rebates = new BankeOrgRebates;
		if ($rebates->fill($request->all())->save()) {
			Flash::success(trans('alerts.orgrebates.created_success'));
			return true;
		}
		Flash::error(trans('alerts.orgrebates.created_error'));
		return false;
	}

}