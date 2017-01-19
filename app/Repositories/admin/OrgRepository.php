<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeOrg;
use Illuminate\Support\Facades\Log;
/**
* 机构仓库
*/
class OrgRepository
{
	/**
	 * datatable获取数据
	 * @author shaolei
	 * @date   2016-04-13T21:14:37+0800
	 * @return [type]                   [description]
	 */
	public function ajaxIndex()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.global.list.start')); /*获取开始*/
		$length = request('length', config('admin.global.list.length')); ///*获取条数*/

		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/

		$name =request('name' ,'');
		$city =request('city' ,'');
		$status = request('status' ,'');

		$org = new BankeOrg;

		/*机构名称搜索*/
		if($name){
			if($search_pattern){
				$org = $org->where('name', 'like', $name);
			}else{
				$org = $org->where('name', $name);
			}
		}

		/*城市搜索*/
		if($city){
			if($search_pattern){
				$org = $org->where('city', 'like', $city);
			}else{
				$org = $org->where('city', $city);
			}
		}

		/*状态搜索*/
		if ($status!=null) {
			$org = $org->where('status', $status);
		}

		$count = $org->count();

		$org = $org->offset($start)->limit($length);
		$orgs = $org->get();

		if ($orgs) {
			foreach ($orgs as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $orgs,
		];
	}

	/**添加机构
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$role = new BankeOrg;
		if ($role->fill($request->all())->save()) {
			Flash::success(trans('alerts.org.created_success'));
			return true;
		}
		Flash::error(trans('alerts.org.created_error'));
		return false;
	}

	/**
	 * 修改机构视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$role = BankeOrg::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
		abort(404);
	}

	/**
	 * 查看机构信息
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$org = BankeOrg::find($id)->toArray();
		return $org;
	}

	/**
	 * 修改机构
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeOrg::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.org.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.org.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 修改机构状态
	 * @author shaolei
	 * @date   2016-04-13T11:51:02+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function mark($id,$status)
	{
		$role = BankeOrg::find($id);
		if ($role) {
			$role->status = $status;
			if ($role->save()) {
				Flash::success(trans('alerts.org.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.org.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除机构
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeOrg::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.org.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.org.deleted_error'));
		return false;
	}

}