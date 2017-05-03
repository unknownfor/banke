<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeBalanceLog;
use App\Models\Banke\BankeCheckIn;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeUserAuthentication;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeUserProfiles;
use Carbon\Carbon;
use Flash;
use DB;
use Auth;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use Monolog\Handler\NewRelicHandlerTest;

/**
* 打卡签到仓库
*/
class CheckinRepository
{
	/**
	 * datatable获取数据
	 * @author shaolei
	 * @date   2016-12-26T11:49:03+0800
	 * @return [type]                   [description]
	 */
	public function ajaxIndex()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.global.list.start')); /*获取开始*/
		$length = request('length', config('admin.global.list.length')); ///*获取条数*/


		$mobile = request('mobile' ,'');
		$name = request('name' ,'');
		$couse_name=request('course_name','');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');

		$checkin = new BankeCheckIn;
		$uid=0;

		/*配置名称搜索*/
		if($mobile){
			$user = BankeUserProfiles::where('mobile',$mobile);
			$uid=$user->first()['uid'];
		}
		if($name){
			$user = BankeUserAuthentication::where('real_name',$name);
			if(count($user)>0){
				$uid=$user->first()['uid'];
			}
		}
		if($mobile || $name){
			$checkin=$checkin->where('uid',$uid);
		}

		if($couse_name){
			$cid=-1;
			$course = BankeCourse::where('name',$couse_name);
			if(count($course)>0){
				$cid=$course->first()['id'];
			}
			$checkin=$checkin->where('course_id',$cid);
		}

		/*配置创建时间搜索*/
		if($created_at_from){
			$checkin = $checkin->where('created_at', '>=', getTime($created_at_from));
		}
		if($created_at_to){
			$checkin = $checkin->where('created_at', '<=', getTime($created_at_to, false));
		}

		/*配置修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
			$checkin = $checkin->where('created_at', '>=', getTime($updated_at_from));
		}
		if($updated_at_to){
			$checkin = $checkin->where('created_at', '<=', getTime($updated_at_to, false));
		}

		$count = $checkin->count();

		$checkin = $checkin->offset($start)->limit($length);
		$checkins = $checkin->orderBy("id", "desc")->get();

		if ($checkins) {
			foreach ($checkins as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
				$user = BankeUserProfiles::find($v['uid']);
				$authen = new BankeUserAuthentication;
				$authen = $authen->find($v['uid']);
				if ($authen && $authen->count() > 0 && $authen['certification_status']==2) {
					$v['name'] = $authen['real_name'];
				}
				$v['mobile'] = $user['mobile'];
				$org = BankeOrg::find($v['org_id']);
				$v['org_name'] = $org['name'];
				$course = BankeCourse::find($v['course_id']);
				$v['course_name'] = $course['name'];
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $checkins,
		];
	}

	/**
	 * 添加配置
	 * @author shaolei
	 * @date   2016-04-13T11:50:22+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$checkin = new BankeCheckIn;
		if ($checkin->fill($request->all())->save()) {
			Flash::success(trans('alerts.$checkin.created_success'));
			return true;
		}
		Flash::error(trans('alerts.$checkin.created_error'));
		return false;
	}
	/**
	 * 修改配置视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$checkin = BankeCheckIn::find($id);
		if ($checkin) {
			$user = BankeUserProfiles::find($checkin['uid']);
			$authen = new BankeUserAuthentication;
			$authen = $authen->find($checkin['uid']);
			if ($authen && $authen->count() > 0 && $authen['certification_status']==2) {
				$checkin['name'] = $authen['real_name'];
			}else{
				$checkin['name'] = $user['name'];
			}
			$checkin['mobile'] = $user['mobile'];
			$org = BankeOrg::find($checkin['org_id']);
			$checkin['org_name'] = $org['name'];
			$course = BankeCourse::find($checkin['course_id']);
			$checkin['course_name'] = $course['name'];
			$checkinArray = $checkin->toArray();
			return $checkinArray;
		}
		abort(404);
	}
	/**
	 * 修改配置
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$input = $request->only(['status', 'comment']);
		$checkin = BankeCheckIn::find($id);
		if ($checkin) {
			if ($checkin->fill($input)->save()) {
				if($input['status'] == config('admin.global.status.ban')){
					DB::beginTransaction();
					try {
						$user_profile = BankeUserProfiles::where('uid', $checkin['uid'])->lockForUpdate()->first();
						$user_profile->account_balance -= $checkin['award_amount'];
						$user_profile->save();

						$cur_user = Auth::user();
						$balance_log = [
							'uid'=>$checkin['uid'],
							'change_amount'=>$checkin['award_amount'],
							'change_type'=>'-',
							'business_type'=>'PUNISHMENT',
							'operator_uid'=>$cur_user['id']
						];
						//记录余额变动日志
						BankeBalanceLog::create($balance_log);
						DB::commit();
						Flash::success(trans('alerts.checkin.updated_success'));
						return true;
					} catch (Exception $e) {
						DB::rollback();
						Log::info($e);
						Flash::error(trans('alerts.checkin.updated_error'));
						return false;
					}
				}
				Flash::success(trans('alerts.checkin.updated_success'));
				return true;
			}else{
				Flash::error(trans('alerts.checkin.updated_error'));
				return false;
			}
		}else{
			abort(404);
		}
	}

	/**
	 * 修改配置状态
	 * @author shaolei
	 * @date   2016-04-13T11:51:02+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function mark($id,$status)
	{
		$checkin = BankeCheckIn::find($id);
		if ($checkin) {
			$checkin->status = $status;
			if ($checkin->save()) {
				Flash::success(trans('alerts.checkin.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.checkin.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除配置
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeCheckIn::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.checkin.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.checkin.deleted_error'));
		return false;
	}

	/**
	 * 根据创建时间，得到 打卡用户
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function getUserInLimitTime($startTime,$endTime)
	{
		$user = new BankeCheckIn();
		$user = $user->where('created_at','>=',getTime($startTime));
		$user = $user->where('created_at','<',getTime($endTime))->get(['uid','created_at']);
		return $user;
	}


	public function remind(){
		$mobile = request('ids', '');
		$mobile='';
	}

	public static  function  getHadCheckinDaysByUIdAndCid($uid,$cid){
		$checkin=new BankeCheckIn();
		$count=$checkin::where(['uid'=>$uid,'course_id'=>$cid]);
		if($count){
			$count=$count->count();
		}else{
			$count=0;
		}
		return $count;
	}

}