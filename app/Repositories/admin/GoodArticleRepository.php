<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeGoodArticle;
use Illuminate\Support\Facades\Log;

/**
* 半课好文章仓库
*/
class GoodArticleRepository
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

		$status = request('status' ,'');

		$goodarticle = new BankeGoodArticle;

		/*状态搜索*/
		if ($status!=null) {
			$goodarticle = $goodarticle->where('status', $status);
		}

		$count = $goodarticle->count();

		$goodarticle = $goodarticle->offset($start)->limit($length);
		$goodarticles = $goodarticle->orderBy("id", "desc")->get();

		if ($goodarticles) {
			foreach ($goodarticles as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $goodarticles,
		];
	}



	/**添加活动
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$goodarticle = new BankeGoodArticle;
		if ($goodarticle->fill($request)->save()) {
			Flash::success(trans('alerts.goodarticle.created_success'));
			return $goodarticle->id;
		}
		Flash::error(trans('alerts.goodarticle.created_error'));
		return false;
	}

	/**
	 * 修改活动
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$role = BankeGoodArticle::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
		abort(404);
	}

	/**
	 * 查看活动
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$goodarticle = BankeGoodArticle::find($id)->toArray();
		return $goodarticle;
	}

	/**
	 * 修改活动
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeGoodArticle::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.goodarticle.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.goodarticle.updated_error'));
			return false;
		}
		abort(404);
	}


	/**
	 * 删除活动
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeGoodArticle::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.goodarticle.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.goodarticle.deleted_error'));
		return false;
	}
}