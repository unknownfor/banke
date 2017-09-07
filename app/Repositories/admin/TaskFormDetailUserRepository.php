<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeTaskFormUser;
use App\Models\Banke\BankeTaskUser;
use App\Models\Banke\BankeTaskFormDetailUser;
use App\Models\Banke\BankeTask;
use App\Models\Banke\BankeTaskCard;
use Illuminate\Support\Facades\Log;
use DB;
use App\Models\Banke\BankeTaskCenter;

/**
* 用户当前天的任务情况
*/
class TaskFormDetailUserRepository
{
	/*
	*更新任务的状态
	 */
	public static function updataTaskFormDetailUser($id){
		$user=BankeTaskFormDetailUser::find($id);
		$user->status=2;
		$user->times_finished=date('Y-m-d H:i:s');
		$user->save();
		self::addPatchCard($user['user_id']);
	}

	/*
	*更新任务的金额数目 以及状态
	 *
	 * */
	public static function updataTaskFormDetailUserAwardData($id,$award){
		$user=BankeTaskFormDetailUser::find($id);
		$user->award_coin=$award;
		$user->status=2;
		$user->times_finished=date('Y-m-d H:i:s');
		$user->save();
		self::addPatchCard($user['user_id']);
	}

	/*领取补领卡*/
	private static function addPatchCard($uid)
	{
		$card=BankeTaskCard::where('user_id',$uid);
		if($card->count()==0){
			$card = new BankeTaskCard;
			$card->card_count=0.5;
			$card->user_id=$uid;
			$card->save();
		}else{
			$card=$card->first();
			$card->card_count+=0.5;
			$card->save();
		}
	}

	/*统一更新用户的任务完成情况*/
	public static  function updataUserFinishStatus($uid,$type,$invitation_award,$form_detail_user_id)
	{
			$BankeTaskUser = new BankeTaskUser ();
			$BankeTaskCenter=new BankeTaskCenter();
			$today=getTime ( date ( "Y/m/d" ) + ' 00:00:00' );
			$todayLast=getTime ( date ( 'Y/m/d 23:59:59', strtotime ( '+1 day' ) ) );
			$BankeTaskUserInfoCount= $BankeTaskUser::where ('user_id', $uid)
			->where ( 'task_id', 3)
			->where ( 'created_at', '>=', $today)
			->where ( 'created_at', '<=', $todayLast)
			->where ( 'status', 2 )
			->count ();
			
		$target_type=0;//1、任务中心  2、任务日历
		
		if($type==5){
			$target_type=1;
			$BankeTaskCenterInfo=$BankeTaskCenter::where(['task_id'=>5,'status'=>1])->first();
			$task_times_max=$BankeTaskCenterInfo['times_max'];
		}else{
			$target_type=2;
			$BankeTaskFormDetailUser=new BankeTaskFormDetailUser();
			$$BankeTaskFormDetailUserInfo=$BankeTaskFormDetailUser::where('id',$form_detail_user_id)->first();
			$task_times_max=$BankeTaskFormDetailUserInfo['times_needed'];
		}
			
			if ($BankeTaskUserInfoCount < $task_times_max) { 
				$BankeTaskUser->user_id=$uid;
				$BankeTaskUser->task_id=3;
				$BankeTaskUser->status=2;
				$BankeTaskUser->award_coin=$invitation_award;
				$BankeTaskUser->coin_real=$invitation_award;
				$BankeTaskUser->times_finished=date('Y-m-d H:i:s');
				$BankeTaskUser->times_needed=$task_times_max;
				$BankeTaskUser->times_real=1;
				$BankeTaskUser->target_type=$target_type;
				$BankeTaskUser->form_detail_user_id=$form_detail_user_id;
				$BankeTaskUser->save ();
			}
	}

}