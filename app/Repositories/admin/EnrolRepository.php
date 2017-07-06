<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeCourse;
use App\Models\Banke\BankeDict;
use App\Models\Banke\BankeEnrol;
use App\Models\Banke\BankeUserProfiles;
use Carbon\Carbon;
use Flash;
use Auth;
use Illuminate\Support\Facades\Log;
use DB;
use UserRepository;
use App\Services\WechatService;
/**
* 预约仓库
*/
class EnrolRepository
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

		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/
		
		$name = request('name' ,'');
		$mobile = request('mobile' ,'');
		$status = request('status' ,'');
		$org_id = request('org_id' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$role = new BankeEnrol;

		/*配置名称搜索*/
		if($name){
			if($search_pattern){
				$role = $role->where('name', 'like', $name);
			}else{
				$role = $role->where('name', $name);
			}
		}

		/*配置名称搜索*/
		if($mobile){
			if($search_pattern){
				$role = $role->where('mobile', 'like', $mobile);
			}else{
				$role = $role->where('mobile', $mobile);
			}
		}

		/*状态搜索*/
		if ($status!=null) {
			$role = $role->where('status', $status);
		}

		/*机构搜索*/
		if ($org_id!=0) {
			$role = $role->where('org_id', $org_id);
		}

		/*配置修改时间搜索*/
		if($updated_at_from){
			$role = $role->where('created_at', '>=', getTime($updated_at_from));
		}
		if($updated_at_to){
			$role = $role->where('created_at', '<=', getTime($updated_at_to, false));	
		}

		$count = $role->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$role = $role->orderBy($orderName, $orderDir);
		}

		$role = $role->offset($start)->limit($length);
		$enrols = $role->orderBy("id", "desc")->get();

		if ($enrols) {
			foreach ($enrols as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
				$v['org_name']=$v->org['name'];
				$course=$v->course;
				if($course){
					$v['course_name']=$course['name'];
				}
			}
		}
//		$resultEnrols=array_reverse($enrols);
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $enrols
		];
	}

	/**
	 * 添加预约。0：预约失败，1：新的预约成功，2：已有预约
	 * @author shaolei
	 * @date   2016-04-13T11:50:22+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$role = new BankeEnrol;
		$param=$request->all();
		$mobile=$param['mobile'];
		$course_id=$param['course_id'];

		if($course_id) {
			$oldEnrol = BankeEnrol::where(['mobile' =>$mobile, 'course_id' =>$param['course_id']]);
			if($oldEnrol->count()>0){
				Flash::success(trans('alerts.enrol.created_success'));
				$this->sendWechatMsg($course_id);
				return 2;
			}
			$this->sendWechatMsg($course_id);
		}
		$user=UserRepository::getUserSimpleInfoByMobile($mobile);
		$param['name']=$user['name'];
		$param['uid']=$user['uid'];
		if ($role->fill($param)->save()) {
			Flash::success(trans('alerts.enrol.created_success'));
			return 1;
		}
		Flash::error(trans('alerts.enrol.created_error'));
		return 0;
	}

	/*预约成功后发送微信消息*/
	private function sendWechatMsg($course_id)
	{
		$course=BankeCourse::find($course_id);
		if($course['name']) {
			$org=$course->org;
			$days=BankeDict::find(13)['value'];
			$content = '恭喜您成功预约 “'.$org['short_name'].' ” 的 '.$course['name'].'，' .
				'机构地址是'.$org['address'].'，' .
				'请尽快在'.$days.'天内到店缴费，' .
				'有疑问请拨打400-034-0033，或者下载半课app咨询在线客服。';
			$wechat = new WechatService();
			$wechat->send_weixn($content);
		}
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
		$role = BankeEnrol::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
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
		$input = $request->all();
		$role = BankeEnrol::find($id);
		$cur_user = Auth::user();
		$input['operator_uid'] = $cur_user['id'];
		if ($role) {
			if ($role->fill($input)->save()) {
				Flash::success(trans('alerts.enrol.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.enrol.updated_error'));
			return false;
		}
		abort(404);
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
		$role = BankeEnrol::find($id);
		if ($role) {
			$role->status = $status;
			if ($role->save()) {
				Flash::success(trans('alerts.enrol.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.enrol.updated_error'));
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
		$isDelete = BankeEnrol::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.enrol.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.enrol.deleted_error'));
		return false;
	}

	/**
	 * 根据创建时间，得到 预约用户
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public static function getEnrolInLimitTime($startTime,$endTime=null)
	{
		$user = new BankeEnrol();
		$user = $user->where('created_at','>=',getTime($startTime));
		if($endTime) {
			$user = $user->where('created_at', '<', getTime($endTime));
		}
		$user = $user->get();
		return $user;
	}

	/**
	 * 根据创建时间，得到 注册半课APP用户 分组，每天多少人
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public static function getEnrolInLimitTimeByGroup($startTime,$endTime)
	{
		$user = new BankeEnrol();
		$user = $user::where('created_at','>=',getTime($startTime));
		$user = $user->where('created_at','<',getTime($endTime));
		$user = $user->groupBy('date')
			->orderBy('date','DESC')
			->get([
				DB::raw('Date(created_at) as date'),
				DB::raw('COUNT(*) as value')
			])
			->toJSON();
		return $user;
	}

	/**
	 * 根据机构id得到多少人 预约
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public static function getEnrolCountsByOrgId($oid)
	{
		$enrol = new BankeEnrol();
		$enrol = $enrol::where('org_id',$oid)->get();
		return $enrol->count();
	}

	/* 根据机构id得到总的预约信息，分页
	* @author jimmy
	* @date   2016-04-14T11:32:04+0800
	* @param  [type]                   $request [description]
	* @return [type]                            [description]
	*/
	public static function getDetailInfoByOrgId($oid,$pageIndex=0,$perCounts=20)
	{
		$allRecord=BankeEnrol::where(['org_id'=>$oid]);
		$count = $allRecord->count();
		$allRecord = $allRecord->orderBy("id", "desc");
		$allRecord = $allRecord->offset($pageIndex*$perCounts)->limit($perCounts);
		$allRecord = $allRecord->get(['uid','mobile','org_id','course_id','course_name','created_at']);
		if ($allRecord) {
			foreach ($allRecord as &$v) {
				$mobile = $v['mobile'];
				$v['mobile']=substr_replace($mobile,'****',3,4);
			}
		}
		return ['record'=>$allRecord,'total'=>$count];
	}

}