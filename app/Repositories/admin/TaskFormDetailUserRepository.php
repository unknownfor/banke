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
class TaskFormDetailUserRepository
{
	/*
	*更新任务的状态
	 */
	public static function updataTaskFormDetailUser($id){
		$user=BankeTaskFormDetailUser::find($id);
		$user->status=2;
		$user->save();
	}

	/*
	*更新任务的金额数目 以及状态
	 *
	 * */
	public static function updataTaskFormDetailUserAwardData($id,$award){
		$user=BankeTaskFormDetailUser::find($id);
		$user->award_coin=$award;
		$user->status=2;
		$user->save();
	}

	public static function addPatchCard($uid)
	{

	}
}