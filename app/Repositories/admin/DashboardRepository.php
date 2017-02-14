<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeFaq;
use App\User;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;

/**
* 仪表盘仓库
*/
class DashboardRepository
{
	public function getTotalData()
	{
		$count1= BankeUserProfiles::all()->toArray()->length;  //注册
		$count2 = BankeEnrol::all()->toArray()->length;//预约
		$count3 = BankeCashBackUser::all()->toArray()->length;//报名
		$count4 = BankeCheckIn::all()->toArray()->length;//打卡

		return array($count1,$count2,$count3,$count4);
	}

}