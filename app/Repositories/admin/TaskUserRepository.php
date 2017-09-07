<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeCommentCourse;
use App\Models\Banke\BankeTaskFormDetailUser;
use Carbon\Carbon;
use Flash;
use DB;
use AppUserRepository;
use League\Flysystem\Exception;
use App\Models\Banke\BankeTaskUser;
use App\Models\Banke\BankeTaskCenter;
use App\Models\Banke\BankeTask;
use TaskFormUserRepository;
use App\Models\Banke\BankeGoodArticle;
use MessageRepository;

/**
*	用户的任务总完成情况
*/
class TaskUserRepository
{

	/**
	 * 修改浏览量  任务类型为（6,7,9）心得，评论，文章
	 * 如果浏览量  等于要求量，则息自动 进行奖励
	 * @author jimmy
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function updateViewCounts($input)
	{
		$taskUser = BankeTaskUser::where([
			'user_id'=>$input['user_id'],
			'task_id'=>$input['task_id'],
			'source_Id'=>$input['source_Id'],
			'form_detail_user_id'=>$input['form_detail_user_id']
		]);

		if ($taskUser->count() > 0) {
			$taskUser=$taskUser->where('status','<',2);
			if ($taskUser->count() > 0) {
				DB::transaction(function () use ($taskUser, $input) {
					try {
						$taskUser = $taskUser->lockForUpdate()->first();

						$times_needed = $taskUser['times_needed'];

						$taskUser['times_real'] = $taskUser['times_real'] + 1;

						if ($times_needed == $taskUser['times_real']) {

							$this->awardUser($input); //执行奖励

							$taskUser->status = 2;
							$taskUser->times_finished = date('Y-m-d H:i:s');

							//任务中心和日历任务不做同步，太难啦，求放过
//							$temp_arr=array(2,3);
//							if(in_array($input['task_id'],$temp_arr)){
//								$this->updateOtherViewCounts($input);
//							}
						}
						$taskUser->save();
					} catch (Exception $e) {
						Flash::error(trans('alerts.course.updated_error'));
						var_dump($e);
						return false;
					}
				});
			}
		}
		else{
			/*创建一条新的任务记录*/
			$this->insertNewData($input);
		}
	}


	/*同步，每日任务或者日历任务*/
	public function updateOtherViewCounts($input){
		$taskUser = new BankeTaskUser();
		if($input['form_detail_user_id']!=0){
			$taskUser =$taskUser->where([
				'user_id'=>$input['user_id'],
				'task_id'=>$input['task_id'],
//				'source_Id'=>$input['source_Id'],
				'form_detail_user_id'=>0
			]);
		}else {
			$taskUser = BankeTaskUser::where([
				'user_id' => $input['user_id'],
				'task_id' => $input['task_id'],
//				'source_Id' => $input['source_Id'],
			]);
			$taskUser=$taskUser->where('created_at', '>=', getTime(date('Y-m-d')));

			$taskUser=$taskUser->where('form_detail_user_id', '>', 0);
//			$taskUser=$taskUser->where('form_detail_user_id', '>', 0);
		}
		$taskUser = $taskUser->where('status', '<', 2);
		if ($taskUser->count() > 0) {
			$taskUser = $taskUser->first();
			$taskUser->status = 2;
			$taskUser->times_finished = date('Y-m-d H:i:s');
			$taskUser['times_real'] = $taskUser['times_needed'];
			$taskUser->save();
			
		}
	}

	/*创建一条新的任务记录*/
	private function insertNewData($input)
	{
		$taskUser = new BankeTaskUser();
		$taskUser->fill($input);
		$taskUser->status=1;
		$taskUser->times_real=1;

		$award_times=$this->getAwardCoinAndTimes($input);
		$taskUser->award_coin=$award_times['award_coin'];
		$taskUser->times_needed=$award_times['times_needed'];

		$taskUser->target_type=$this->getTargetType($input);
		$taskUser->save();
	}

	/*
	* 得到任务的来源
	* 1、任务中心 2、任务日历',
	*/
	private function getTargetType($input){
		if($input['form_detail_user_id']!=0){
			$from = 2;
			switch($input['task_id']){
				case 9:
					$from = BankeGoodArticle::find($input['source_Id'])['type'];
					break;
				default:
					break;
			}
			return $from;
		}else{
			return 1;
		}


	}

	/*得到奖励金额的来源*/
	private function getAwardCoinAndTimes($input){
		if($input['form_detail_user_id']!=0){
			return BankeTaskFormDetailUser::find($input['form_detail_user_id']);
		}else{
			return BankeTaskCenter::where('task_id',$input['task_id'])->first();
		}
	}

	/*
	 * *执行奖励,
	 * 区分每日任务和日历任务
	 * */
	private function awardUser($input){
		if($input['form_detail_user_id']!=0) {
			$info_obj = $this->getTodayTaskFormUser($input);
			if ($info_obj) {
				$award = $info_obj['award'];  //奖励金额
				$this->execAward($award,$input);
			}
		}else{
			$award = $this->getAwardCoinAndTimes($input)['award_coin'];  //奖励金额
			$this->execAward($award,$input);
		}
	}

	/*
	 * *执行奖励,
	 * 区分每日任务和日历任务
	 * */
	private function execAward($award,$input){
		AppUserRepository::execUpdateUserAccountInfo($input['user_id'], $award, 1, 10);

		//系统消息
		$input['award'] = $award;
		MessageRepository::addNewMessage($input);
	}

	/*
	 *  获得今天的任务情况
	 */
	private function getTodayTaskFormUser($input){
		//判断是否为今天任务
		$info_obj = TaskFormUserRepository::getMiniViewCountsAndAward($input['task_id'], $input['user_id']);
		if ($info_obj == null) {
			Flash::error(trans('不是今天的任务'));
			return false;
		}

		//更新task_form_user_detail 的相应字段
		TaskFormDetailUserRepository::updataTaskFormDetailUser($info_obj['id']);
		return $info_obj;
	}

	/**
	 * 一次性可完成的任务
	 * 邀请注册，邀请报名。
	 * 不用区分来自于任务中心还是日历任务
	 */
	public function oneTimesTask($input)
	{
		$taskUser = BankeTaskUser::lockForUpdate()->where([
			'user_id'=>$input['user_id'],
			'task_id'=>$input['task_id']
		]);

		if ($taskUser->count() == 0) {
			$this->insertNewData($input);
		}
	}
	
}