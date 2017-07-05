<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeMoneyNews;
use Carbon\Carbon;
use Flash;
/**
* 赚钱动态仓库
*/
class MoneyNewsRepository
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
		$news = new BankeMoneyNews;


		/*状态搜索*/
		if ($status !=null ) {
			$news = $news->where('status', $status);
		}


		$count = $news->count();


		$news = $news->offset($start)->limit($length);
		$news = $news->orderBy("id", "desc")->get();
               

		if ($news) {
			foreach ($news as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
			}
		}
               
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $news,
		];
	}

	/**
	 * 添加赚钱动态
	 * @author shaolei
	 * @date   2016-04-13T11:50:22+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{   
		$news = new BankeMoneyNews;
		if ($news->fill($request->all())->save()) {
			Flash::success(trans('alerts.moneynews.created_success'));
			return true;
		}
		Flash::error(trans('alerts.moneynews.created_error'));
		return false;
	}
	/**
	 * 修改赚钱动态视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$news = BankeMoneyNews::find($id);
		if ($news) {
			$newsArray = $news->toArray();
			return $newsArray;
		}
		abort(404);
	}
	/**
	 * 修改赚钱动态
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$news = BankeMoneyNews::find($id);
		if ($news) {
			if ($news->fill($request->all())->save()) {
				Flash::success(trans('alerts.moneynews.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.moneynews.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 修改赚钱动态状态
	 * @author shaolei
	 * @date   2016-04-13T11:51:02+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function mark($id,$status)
	{
		$news = BankeMoneyNews::find($id);
		if ($news) {
			$news->status = $status;
			if ($news->save()) {
				Flash::success(trans('alerts.moneynews.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.moneynews.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除赚钱动态
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeMoneyNews::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.moneynews.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.moneynews.deleted_error'));
		return false;
	}

}