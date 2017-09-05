<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeTaskFormUser;
use App\Models\Banke\BankeTaskFormDetailUser;
use App\Models\Banke\BankeTask;
use App\Models\Banke\BankeTaskCard;
use Illuminate\Support\Facades\Log;
use DB;

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
		$uid=1;
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
	private static  function updataUserFinishStatus($uid,$type)
	{

	}

}