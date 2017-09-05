<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeTaskFormDetail;
use App\Models\Banke\BankeTask;
use Illuminate\Support\Facades\Log;
use DB;

/**
* 15天任务表仓库
*/
class TaskFormDetailRepository
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

		$taskFormDetail = new BankeTaskFormDetail;

		/*状态搜索*/
		if ($status!=null) {
			$taskFormDetail = $taskFormDetail->where('status', $status);
		}

		$count = $taskFormDetail->count();

		$taskFormDetail = $taskFormDetail->offset($start)->limit($length);
		$taskFormDetails = $taskFormDetail->orderBy("id", "desc")->get();

		if ($taskFormDetails) {
			foreach ($taskFormDetails as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
				$taskform=$v->taskform;
				$v['task_type_name']=$v->tasktype['name'];
				$v['seq_no_name']=$taskform['name'];
				$v['user_type']=$taskform['user_type'];
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $taskFormDetails,
		];
	}



	/**添加15任务
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$input=$request->all();
		$taskFormId=$input['task_form_id'];
		$taskFormDetail=BankeTaskFormDetail::where('task_form_id',$taskFormId);
		if($taskFormDetail->count()>0){
			Flash::error(trans('alerts.taskformdetail.already_created_error'));
			return false;
		}


		//TODO 录入新的任务
//		selected_task
		//事务
		DB::transaction( function () use ($input,$taskFormId){
			try {
				$taskNamesArr=[
					'第一天',
					'第二天',
					'第三天',
					'第四天',
					'第五天',
					'第六天',
					'第七天',
					'第八天',
					'第九天',
					'第十天',
					'第十一天',
					'第十二天',
					'第十三天',
					'第十四天',
					'第十五天',
					'宝箱1',
					'宝箱2',
					'宝箱3',
				];
				$allTask=BankeTask::get(['type', 'award_coin']);
				$taskArr=explode(',',$input['selected_task']);
				//添加三个宝箱任务类型
				array_push($taskArr,12);
				array_push($taskArr,12);
				array_push($taskArr,12);
				$arr = array();
				foreach($taskArr as $key=>$v){
					$coin=$this->getAwardCoinByTaskType($v,$allTask);
					$daysInfo=$this->getDaysByTaskType($taskNamesArr[$key]);
					$days=($key+1);
					if(!$daysInfo['flag']){
						$days=$daysInfo['days'];
						$coin=$daysInfo['award_coin'];
					}
					$tempaArr = array(
						'task_id'=>$v,
						'task_form_id'=>$taskFormId,
						'name'=>$taskNamesArr[$key],
						'seq_no'=>$days,
						'award_coin'=>$coin,
						'flag'=>1,
						'times_needed'=>1,
					);
					Array_push($arr, $tempaArr);
				}
				DB::table('banke_task_form_detail')->insert($arr);
				Flash::success(trans('alerts.taskformdetail.created_success'));
				return true;
			} catch (Exception $e) {
				Flash::error(trans('alerts.taskformdetail.created_error'));
				return false;
			}
		});
	}

	private  function  getAwardCoinByTaskType($type,$allTask){
		foreach($allTask as $v){
			if($v['type']==$type){
				return $v['award_coin'];
			}
		}
	}

	/*如果是宝箱1，则为第5天；宝箱2，则为第10天；宝箱3，则为第15天， */
	private  function  getDaysByTaskType($name){
		$daysInfo=[
			'flag'=>false,
			'days'=>5,
			'award_coin'=>20
		];
		switch ($name){
			case '宝箱1':
				$daysInfo['days']=5;
				break;
			case '宝箱2':
				$daysInfo['days']=10;
				$daysInfo['award_coin']=50;
				break;
			case '宝箱3':
				$daysInfo['days']=15;
				$daysInfo['award_coin']=100;
				break;
			default:
				$daysInfo['flag']=true;
				break;
		}
		return $daysInfo;
	}

	/**添加15任务 可以点击的外链
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function storeOutlinkClick($request)
	{
		$input=$request->all();
		$taskFormDetail = new BankeTaskFormDetail;
		if ($taskFormDetail->fill($request->all())->save()) {
			Flash::success(trans('alerts.taskformdetail.created_success'));
			return $taskFormDetail->id;
		}
		Flash::error(trans('alerts.taskformdetail.created_error'));
		return false;
	}

	/**
	 * 修改15任务
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$role = BankeTaskFormDetail::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
		abort(404);
	}

	/**
	 * 查看15任务
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$taskFormDetail = BankeTaskFormDetail::find($id)->toArray();
		return $taskFormDetail;
	}

	/**
	 * 修改15任务
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeTaskFormDetail::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.taskformdetail.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.taskformdetail.updated_error'));
			return false;
		}
		abort(404);
	}


	/**
	 * 删除15任务
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeTaskFormDetail::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.taskformdetail.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.taskformdetail.deleted_error'));
		return false;
	}
}