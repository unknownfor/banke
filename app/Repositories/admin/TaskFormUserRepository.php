<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeTaskFormUser;
use App\Models\Banke\BankeTaskFormDetailUser;
use App\Models\Banke\BankeTask;
use Illuminate\Support\Facades\Log;
use DB;

/**
* 用户当前天的任务情况
*/
class TaskFormUserRepository
{
	/*
	 * 获得任务的最低浏览次数以及奖励次数
	 * $type:6:心得分享，7：机构评论分享
	 */
	public static function getMiniViewCountsAndAward($type,$uid){
		$user=BankeTaskFormUser::where('user_id',$uid);
		if($user->count()>0) {
			$user=$user->orderBy('id', 'desc')->first();
			$task_form_id = $user['task_form_id'];
			$current_seq=$user['current_seq'];
			$detailuser=BankeTaskFormDetailUser::where([
				'task_form_id'=>$task_form_id,
				'seq_no'=>$current_seq,
				'user_id'=>$uid,
				'status'=>1
			]);
			if($detailuser->count()>0) {
				$detailuser=$detailuser->first();
				return array(
					'id'=>$detailuser->id,
					'times'=>$detailuser->times_needed,
					'award'=>$detailuser->award_coin

				);
			}
		}
	}
}