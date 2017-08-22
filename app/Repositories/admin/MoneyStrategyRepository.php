<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeMoneyStrategy;
use Carbon\Carbon;
use Flash;
use DB;
/**
* 赚钱攻略仓库
*/
class MoneyStrategyRepository
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
		$strategy = new BankeMoneyStrategy;


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
		$strategy = $strategy->orderBy("sort", "desc")->orderBy('id','desc')->get();
               

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
	 * 添加攻略
	 * @author shaolei
	 * @date   2016-04-13T11:50:22+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{   
		$strategy = new BankeMoneyStrategy;
		if ($strategy->fill($request->all())->save()) {
			Flash::success(trans('alerts.moneystrategy.created_success'));
			return true;
		}
		Flash::error(trans('alerts.moneystrategy.created_error'));
		return false;
	}


	/**
	 * 添加攻略 批量
	 * @author shaolei
	 * @date   2016-04-13T11:50:22+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function storeMultiple($request,$user_type_arr)
	{
		$time=date("Y-m-d H:i:s");
		$arr=[];
		$input=$request->all();
		foreach($user_type_arr as $v){
			$temp_arr = [
				'title'=>$input['title'],
				'content'=>$input['content'],
				'sort'=>$input['sort'],
				'status'=>$input['status'],
				'user_type'=>$v,
				'cover_img'=>$input['cover_img'],
				'author'=>$input['author'],
				'created_at'=>$time,
				'updated_at'=>$time,
			];
			array_push($arr,$temp_arr);
		}

		if(DB::table('banke_money_strategy')->insert($arr)) {
			Flash::success(trans('alerts.moneystrategy.created_success'));
			return true;
		}
		Flash::error(trans('alerts.moneystrategy.created_error'));
		return false;
	}

	/**
	 * 修改攻略视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$strategy = BankeMoneyStrategy::find($id);
		if ($strategy) {
			$strategyArray = $strategy->toArray();
			return $strategyArray;
		}
		abort(404);
	}
	/**
	 * 修改攻略
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$strategy = BankeMoneyStrategy::find($id);
		if ($strategy) {
			if ($strategy->fill($request->all())->save()) {
				Flash::success(trans('alerts.moneystrategy.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.moneystrategy.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 修改攻略状态
	 * @author shaolei
	 * @date   2016-04-13T11:51:02+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function mark($id,$status)
	{
		$strategy = BankeMoneyStrategy::find($id);
		if ($strategy) {
			$strategy->status = $status;
			if ($strategy->save()) {
				Flash::success(trans('alerts.moneystrategy.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.moneystrategy.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除攻略
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeMoneyStrategy::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.moneystrategy.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.moneystrategy.deleted_error'));
		return false;
	}

	public static function  getAll()
	{
		return BankeMoneyStrategy::where('status',1)->get();
	}

}