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

		//认证
		$authenUser=new BankeUserAuthentication();
		if($type=='today') {
			$authenUser = $authenUser->where('created_at', '>=', getTime($today));
		}else{
			$authenUser = $authenUser->where('created_at', '>=', getTime($yesterdate));
			$authenUser = $authenUser->where('created_at', '<', getTime($today));
		}
		$count2 = $authenUser->where('certification_status',2)->count();//认证

		//预约
		$enrol=new BankeEnrol;
		if($type=='today') {
			$enrol = $enrol->where('created_at', '>=', getTime($today));
		}else{
			$enrol = $enrol->where('created_at', '>=', getTime($yesterdate));
			$enrol = $enrol->where('created_at', '<', getTime($today));
		}
		$count3 = $enrol->count();//预约

		//报名
		$cashUserUser=new BankeCashBackUser;
		if($type=='today') {
			$cashUserUser = $cashUserUser->where('created_at', '>=', getTime($today));
		}else{
			$cashUserUser = $cashUserUser->where('created_at', '>=', getTime($yesterdate));
			$cashUserUser = $cashUserUser->where('created_at', '<', getTime($today));
		}
		$count4 = $cashUserUser->where('status',1)->count();//报名

		//打卡
		$checkin=new BankeCheckIn;
		if($type=='today') {
			$checkin = $checkin->where('created_at', '>=', getTime($today));
		}else{
			$checkin = $checkin->where('created_at', '>=', getTime($yesterdate));
			$checkin = $checkin->where('created_at', '<', getTime($today));
		}
		$count5 = $checkin->count();//打卡

		//提现
		$withDraw=new BankeWithdraw();
		if($type=='today') {
			$withDraw = $withDraw->where('created_at', '>=', getTime($today));
		}else{
			$withDraw = $withDraw->where('created_at', '>=', getTime($yesterdate));
			$withDraw = $withDraw->where('created_at', '<', getTime($today));
		}
		$count6 = $withDraw->where('status',1)->count();//提现

		return array($count1,$count2,$count3,$count4,$count5,$count6);
	}

	/*
	 *过去7天的数据
	 */
	public function getPassSeventDaysData()
	{
		$time = time();
		$today = date("Y-m-d",$time); //2010-08-29
		$yesterdate=date("Y-m-d",strtotime("-6 day"));

		//注册
		$registerUser=new AppUserRepository();
		$count1=$registerUser->getUserInLimitTime($yesterdate,$today)->count();

		//预约
		$enrol=new EnrolRepository();
		$count2=$enrol->getUserInLimitTime($yesterdate,$today)->count();

		//打卡
		$enrol=new CheckinRepository();
		$count3=$enrol->getUserInLimitTime($yesterdate,$today)->count();

		//报名
		$enrol=new OrderRepository();
		$count4=$enrol->getUserInLimitTime($yesterdate,$today)->count();

		return array($count1,$count2,$count3,$count4);

	}


}