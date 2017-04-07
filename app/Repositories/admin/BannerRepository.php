<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeBanner;
use Carbon\Carbon;
use Flash;
/**
* 新闻仓库
*/
class BannerRepository
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

		$status = request('status' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$banner = new BankeBanner;


		/*状态搜索*/
		if ($status) {
			$banner = $banner->where('status', $status);
		}

		/*配置创建时间搜索*/
		if($created_at_from){
			$banner = $banner->where('created_at', '>=', getTime($created_at_from));
		}
		if($created_at_to){
			$banner = $banner->where('created_at', '<=', getTime($created_at_to, false));
		}

		/*配置修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
			$banner = $banner->where('created_at', '>=', getTime($updated_at_from));
		}
		if($updated_at_to){
			$banner = $banner->where('created_at', '<=', getTime($updated_at_to, false));
		}

		$count = $banner->count();


		$banner = $banner->offset($start)->limit($length);
		$banners = $banner->orderBy("id", "desc")->get();
               

		if ($banners) {
			foreach ($banners as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
			}
		}
               
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $banners,
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
		$banner = new BankeBanner;
		if ($banner->fill($request->all())->save()) {
			Flash::success(trans('alerts.news.created_success'));
			return true;
		}
		Flash::error(trans('alerts.news.created_error'));
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
		$banner = BankeBanner::find($id);
		if ($banner) {
			$bannerArray = $banner->toArray();
			return $bannerArray;
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
		$banner = BankeBanner::find($id);
		if ($banner) {
			if ($banner->fill($request->all())->save()) {
				Flash::success(trans('alerts.news.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.news.updated_error'));
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
		$banner = BankeBanner::find($id);
		if ($banner) {
			$banner->status = $status;
			if ($banner->save()) {
				Flash::success(trans('alerts.news.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.news.updated_error'));
			return false;
		}
		abort(404);
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
		$isDelete = BankeBanner::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.news.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.news.deleted_error'));
		return false;
	}

}