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
}