<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeTrainCategory;
use Flash;
/**
* 教育分类仓库
*/
class TrainCategoryRepository
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
		$name = request('name' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$trainCategory = new BankeTrainCategory;


		/*状态搜索*/
		if ($status!=null) {
			$trainCategory = $trainCategory->where('status', $status);
		}

		/*标题*/
		if ($name) {
			$trainCategory = $trainCategory->where('name', $name);
		}

		/*配置创建时间搜索*/
		if($created_at_from){
			$trainCategory = $trainCategory->where('created_at', '>=', getTime($created_at_from));
		}
		if($created_at_to){
			$trainCategory = $trainCategory->where('created_at', '<=', getTime($created_at_to, false));
		}

		$count = $trainCategory->count();


		$trainCategory = $trainCategory->offset($start)->limit($length);
		$trainCategories = $trainCategory->orderBy("sort")->get();
               

		if ($trainCategories) {
			foreach ($trainCategories as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
				if($v['pid']!=0){
					$v['pid']=BankeTrainCategory::find($v['pid'])['name'];
				}else{
					$v['pid']='';
				}
			}
		}
               
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $trainCategories,
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
		$trainCategory = new BankeTrainCategory;
		if ($trainCategory->fill($request->all())->save()) {
			Flash::success(trans('alerts.traincategory.created_success'));
			return true;
		}
		Flash::error(trans('alerts.traincategory.created_error'));
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
		$trainCategory = BankeTrainCategory::find($id);
		if ($trainCategory) {
			$trainCategoryArray = $trainCategory->toArray();
			return $trainCategoryArray;
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
		$trainCategory = BankeTrainCategory::find($id);
		if ($trainCategory) {
			if ($trainCategory->fill($request->all())->save()) {
				Flash::success(trans('alerts.traincategory.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.traincategory.updated_error'));
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
		$trainCategory = BankeTrainCategory::find($id);
		if ($trainCategory) {
			$trainCategory->status = $status;
			if ($trainCategory->save()) {
				Flash::success(trans('alerts.traincategory.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.traincategory.updated_error'));
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
		$isDelete = BankeTrainCategory::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.traincategory.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.traincategory.deleted_error'));
		return false;
	}

	//得到全部的顶级分类
	public function  getAllTopCategory(){
		return BankeTrainCategory::where('pid',0)->get(['id','name']);
	}
}