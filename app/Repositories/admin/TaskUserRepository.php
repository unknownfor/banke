<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeCommentCourse;
use App\Models\Banke\BankeTaskFormDetailUser;
use Carbon\Carbon;
use Flash;
use DB;
use App\Repositories\admin\AppUserRepository;
use League\Flysystem\Exception;
use App\Models\Banke\BankeTaskUser;
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
	 * 修改浏览量
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
			'user_id'=>$input['uid'],
			'task_id'=>$input['task_id'],
			'source_Id'=>$input['source_id'],
			'form_user_detail_id'=>$input['form_user_detail_id']
		]);
		$taskUser=$taskUser->where('status','<',2);

		if($taskUser->count()>0){
			$taskUser=$taskUser->first();

			$times_needed=$taskUser['times_needed'];

			$taskUser['times_real']=$taskUser['times_real'] + 1;

			if($times_needed==$taskUser['times_real']) {
				$info_obj = TaskFormUserRepository::getMiniViewCountsAndAward(9, $input['uid']);
				if ($info_obj == null) {
					Flash::error(trans('alerts.course.updated_error'));
					return false;
				}
				$award = $info_obj['award'];  //奖励金额

				AppUserRepository::execUpdateUserAccountInfo($input['uid'], $award, 1, 10);

				$input['award']=$award;
				MessageRepository::addNewMessage($input);

				//更新task_form_user_detail 的相应字段
				TaskFormDetailUserRepository::updataTaskFormDetailUser($info_obj['id']);

				$taskUser->status=2;
			}
			$taskUser->save();
		}
		else{

			self::insertNewData($input);
		}
	}

	/*创建一条新的任务记录*/
	private static function insertNewData($input)
	{
		$taskUser = new BankeTaskUser();
		$taskUser->fill($input);
		$taskUser->status=1;
		$taskUser->times_real=1;

		$task=BankeTask::find($input['task_id']);
		$taskUser->award_coin=$task['award_coin'];

		$taskFormDetailUser=BankeTaskFormDetailUser::find($input['form_user_detail_id']);
		$taskUser->times_needed=$taskFormDetailUser['times_needed'];

		$task->target_type=self::getTargetType($input['task_id'],$input['source_id']);
		$task->save();
	}

	/*得到任务的来源*/
	private static function getTargetType($taskid,$id){
		$from = 2;  //1、任务中心 2、任务日历',
		switch($taskid){
			case 9:
				$from = BankeGoodArticle::find($id)['type'];
				break;
			default:
				break;
		}
		return $from;
	}
	
}