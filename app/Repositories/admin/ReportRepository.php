<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeReport;
use App\User;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;

/**
* 媒体报道仓库
*/
class ReportRepository
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

		$report = new BankeReport;


		/*配置名称搜索*/
		if($title){
			if($search_pattern){
				$report = $report->where('title', 'like', $title);
			}else{
				$report = $report->where('title', $title);
			}
		}
		/*状态搜索*/
		if ($status!=null) {
			$report = $report->where('status', $status);
		}

		$count = $report->count();

		$report = $report->offset($start)->limit($length);
		$reports = $report->get();

		if ($reports) {
			foreach ($reports as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(true);
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $reports,
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
		$isDelete = BankeReport::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.report.soft_deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.report.soft_deleted_error'));
		return false;
	}

	/**
	 * 查看媒体报道信息
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{

		$report = BankeReport::find($id)->toArray();
		return $report;
	}

	/**
	 * 修改媒体报道视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$role = BankeReport::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
		abort(404);
	}

	/**
	 * 修改媒体报道
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeReport::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.report.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.report.updated_error'));
			return false;
		}
		abort(404);
	}


	/**添加媒体报道
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$report = new BankeReport;
		if ($report->fill($request->all())->save()) {
			Flash::success(trans('alerts.report.created_success'));
			return true;
		}
		Flash::error(trans('alerts.report.created_error'));
		return false;
	}

	/**top5媒体报道
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function getTop5()
	{
		$report = new BankeReport;
		$report = $report->where('status', 1)->orderBy('id', false);
		$report = $report->offset(0)->limit(5);
		$reports = $report->get()->all();
		return $reports;
	}

}