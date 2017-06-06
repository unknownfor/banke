<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeOrgApplyFor;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;

/**
* 机构申请仓库
*/
class OrgApplyForRepository
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

		$read_status = request('read_status' ,'');

		$orgApplyFor = new BankeOrgApplyFor();

		if ($read_status!=null) {
			$orgApplyFor = $orgApplyFor->where('read_status', $read_status);
		}

		$count = $orgApplyFor->count();

		$orgApplyFor = $orgApplyFor->offset($start)->limit($length);
		$orgApplyFors = $orgApplyFor->orderBy("id", "desc")->get();

		if ($orgApplyFors) {
			foreach ($orgApplyFors as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(true);
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $orgApplyFors,
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
		$orgApplyFor = BankeOrgApplyFor::find($id)->toArray();
		return $orgApplyFor;
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
		$orgApplyFor = BankeOrgApplyFor::find($id);
		if ($orgApplyFor) {
			$roleArray = $orgApplyFor->toArray();
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
		$role = BankeOrgApplyFor::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.orgapplyfor.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.orgapplyfor.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除机构申请	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeOrgApplyFor::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.orgapplyfor.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.orgapplyfor.deleted_error'));
		return false;
	}

	/**
	 * 添加申请机构信息
	 * @author jimmy
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function addOrgApplyFor($request)
	{
		$org=new BankeOrgApplyFor();
		$org = $org::where('name',$request['name']);
		if ($org->count()==0) {
			$request['status']=0;
			$org1=new BankeOrgApplyFor;
			if ($org1->fill($request->all())->save()) {
				Flash::success(trans('alerts.orgapplyfor.updated_success'));
				return array("status"=>true,"msg"=>"机构申请添加成功");
			}
			return array("status"=>false,"msg"=>"机构申请添加失败");
		}else{
			return array("status"=>false,"msg"=>"该机构已存在");
		}
	}

	/*更新阅读状态*/
	public static function updateReadStatus($id)
	{
		$record =BankeOrgApplyFor::find($id);
		$record['read_status']=1;
		if ($record->save()) {
			return true;
		}else{
			return false;
		}
	}
}