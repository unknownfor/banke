<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeCashBackUser;
use App\Models\Banke\BankeCommentCourse;
use Carbon\Carbon;
use Flash;
use DB;
use App\Repositories\admin\AppUserRepository;
use League\Flysystem\Exception;
use App\Models\Banke\BankeTaskUser;
use App\Models\Banke\BankeOrg;
use TaskFormUserRepository;
use TaskFormDetailUserRepository;

/**
*	半课好文
*/
class ArticleRepository
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
	public static function updateViewCounts($id,$uid)
	{
		$taskUser = BankeTaskUser::where(['user_id'=>$uid,'task_id'=>9,'source_Id'=>$id])->where('status','<',2);
		if($taskUser->count()>0){
			$taskUser=$taskUser->first();

			$times_needed=$taskUser['times_needed'];

			if($times_needed==$taskUser['times_real']){
				$info_obj = TaskFormDetailUserRepository::getMiniViewCountsAndAward(9,$uid);
				if($info_obj == null){
					Flash::error(trans('alerts.course.updated_error'));
					return false;
				}
				$award=$info_obj['award'];  //奖励金额

				AppUserRepository::execUpdateUserAccountInfo($uid,$award,1,10);

				//消息记录
				$message = [
					'status' => 0,
					'uid' => $uid,
					'title' => '评论奖励',
					'content' => '感谢您分享的好文章,平台已奖励您' . $award . '元现金，快去现金钱包里查看吧！',
					'type' => config('admin.global.balance_log')[13]['key']
				];
				//记录消息
				BankeMessage::create($message);

				//更新task_form_user_detail 的相应字段
				TaskFormDetailUserRepository::updataTaskFormDetailUser($info_obj['id']);
			}else{
				$taskUser['times_real']=$taskUser['times_real'] + 1;
			}
			$taskUser->save();
		}else{

		}
	}
	
}