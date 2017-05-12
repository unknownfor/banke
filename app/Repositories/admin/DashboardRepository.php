<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeUserAuthentication;
use App\Models\Banke\BankeWithdraw;
use Carbon\Carbon;
use EasyWeChat\Payment\Order;
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
use AppUserRepository;
use OrderRepository;
use EnroRepository;
use CheckinRepository;
use WithdrawRepository;

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
		$count2 = BankeUserAuthentication::where('certification_status',2)->get()->toArray();//认证
		$count3 = BankeEnrol::all()->toArray();//预约
		$count4 = BankeCashBackUser::where('status',1)->get()->toArray();//报名
		$count5 = BankeCheckIn::all()->toArray();//打卡
		$count6 = BankeWithdraw::where('status',1)->get()->toArray();//提现次数

		return array(count($count1),count($count2),count($count3),count($count4),count($count5),count($count6));
	}

	/*
	 *今天和昨天的数据
	 */
	public function getRecentlyData($type)
	{

		$time = time();
		$today = date("Y-m-d",$time); //2010-08-29
		$yesterdate=date("Y-m-d",strtotime("-1 day"));

//		注册
		if($type=='today') {
			$registerUser = AppUserRepository::getUserInLimitTime($today,null);
		}else{
			$registerUser = AppUserRepository::getUserInLimitTime($yesterdate,$today);
		}
		$count1 = $registerUser->count();//注册

		//认证
		if($type=='today') {
			$authenUser =AppUserRepository::getUserInLimitTime($today,null,true);
		}else{
			$authenUser =AppUserRepository::getUserInLimitTime($yesterdate,$today,true);
		}
		$count2 = $authenUser->count();//认证

		//预约
		if($type=='today') {
			$enrol = EnrolRepository::getEnrolInLimitTime($today);
		}else{
			$enrol = EnrolRepository::getEnrolInLimitTime($yesterdate,$today);
		}
		$count3 = $enrol->count();//预约

		//报名
		if($type=='today') {
			$cashUserUser=OrderRepository::getOrderInLimitTime($today);
		}else{
			$cashUserUser=OrderRepository::getOrderInLimitTime($yesterdate,$today);
		}
		$count4 = $cashUserUser->count();//报名

		//打卡
		if($type=='today') {
			$checkin = CheckinRepository::getCheckinInLimitTime($today);
		}else{
			$checkin = CheckinRepository::getCheckinInLimitTime($yesterdate,$today);
		}
		$count5 = $checkin->count();//打卡

		//提现
		if($type=='today') {
			$withDraw = WithdrawRepository::getWithdrawInLimitTime($today);
		}else{
			$withDraw = WithdrawRepository::getWithdrawInLimitTime($yesterdate,$today);
		}
		$count6 = $withDraw->count();//提现

		return array($count1,$count2,$count3,$count4,$count5,$count6);
	}

	/*
	 *过去7天的数据
	 */
	public function getPassSeventDaysData()
	{
		$yesterdate=date("Y-m-d",strtotime("-6 day"));
		$today=date("Y-m-d",strtotime("1 day"));

		//注册
		$list1=AppUserRepository::getUserInLimitTimeByGroup($yesterdate,$today);

		//报名
		$list2=OrderRepository::getOrderInLimitTimeByGroup($yesterdate,$today);

		//打卡
		$list3=CheckinRepository::getCheckinInLimitTimeByGroup($yesterdate,$today);

		//预约
		$list4=EnrolRepository::getEnrolInLimitTimeByGroup($yesterdate,$today);

		return array($list1,$list2,$list3,$list4);

	}


}