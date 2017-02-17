<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeUserProfiles;
use App\Models\Banke\BankeEnrol;
use App\Models\Banke\BankeCashBackUser;
use App\Models\Banke\BankeCheckIn;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use DB;
use Auth;

/**
* 仪表盘仓库
*/
class DashboardRepository
{
	/*
	 *所有总体数据
	 */
	public function getTotalData()
	{
		$count1= BankeUserProfiles::all()->toArray();//注册
		$count2 = BankeEnrol::all()->toArray();//预约
		$count3 = BankeCashBackUser::all()->toArray();//报名
		$count4 = BankeCheckIn::all()->toArray();//打卡

		return array(count($count1),count($count2),count($count3),count($count4));
	}

	/*
	 *今天和昨天的数据
	 */
	public function getRecentlyData($type)
	{

		$time = time();
		$today = date("Y-m-d",$time); //2010-08-29
		$yesterdate=date("Y-m-d",strtotime("-1 day"));
		$tomorowdate=date("Y-m-d",strtotime("1 day"));

		//注册
		$registerUser=new BankeUserProfiles;
		if($type=='today') {
			$registerUser = $registerUser->where('created_at', '>=', getTime($today));
		}else{
			$registerUser = $registerUser->where('created_at', '>=', getTime($yesterdate));
			$registerUser = $registerUser->where('created_at', '<', getTime($today));
		}
		$count1 = $registerUser->count();//注册

		//预约
		$enrol=new BankeEnrol;
		if($type=='today') {
			$enrol = $enrol->where('created_at', '>=', getTime($today));
		}else{
			$enrol = $enrol->where('created_at', '>=', getTime($yesterdate));
			$enrol = $enrol->where('created_at', '<', getTime($today));
		}
		$count2 = $enrol->count();//预约

		//报名
		$cashUserUser=new BankeCashBackUser;
		if($type=='today') {
			$cashUserUser = $cashUserUser->where('created_at', '>=', getTime($today));
		}else{
			$cashUserUser = $cashUserUser->where('created_at', '>=', getTime($yesterdate));
			$cashUserUser = $cashUserUser->where('created_at', '<', getTime($today));
		}
		$count3 = $cashUserUser->count();//报名

		//打卡
		$checkin=new BankeCheckIn;
		if($type=='today') {
			$checkin = $checkin->where('created_at', '>=', getTime($today));
		}else{
			$checkin = $checkin->where('created_at', '>=', getTime($yesterdate));
			$checkin = $checkin->where('created_at', '<', getTime($today));
		}
		$count4 = $checkin->count();//打卡

		return array($count1,$count2,$count3,$count4);
	}

}