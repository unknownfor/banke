<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeTeachingTeahcer;
use Carbon\Carbon;
use Flash;
use DB;
/**
* 教学老师仓库
*/
class TeachingTeacherRepository
{
	/**
	 * 教学老师
	 * @author shaolei
	 * @date   2016-04-13T11:50:22+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function ajaxIndex()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.global.list.start')); /*获取开始*/
		$length = request('length', config('admin.global.list.length')); ///*获取条数*/

		$name = request('name' ,'');
		$sub_org_id = request('sub_org_id' ,'');
		$status = request('status' ,'');
		$teacher = new BankeTeachingTeacher;

		/*名称搜索*/
		if($name!=null){
			$teacher = $teacher::where('name','like',$name);
		}

		/*子机构id搜索*/
		if($sub_org_id!=null){
			$teacher = $teacher::where('sub_org_id',$sub_org_id);
		}

		/*状态搜索*/
		if($status!=null){
			$teacher = $teacher::where('status',$status);
		}

		$count = $teacher->count();

		$teacher = $teacher->offset($start)->limit($length);
		$teachers = $teacher->orderBy("id", "desc")->get();

		if ($teachers) {
			foreach ($teachers as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $teachers,
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
		$teacher = new BankeTeachingTeacher;
		if ($teacher->fill($request->all())->save()) {
			Flash::success(trans('alerts.$teacher.created_success'));
			return true;
		}
		Flash::error(trans('alerts.$teacher.created_error'));
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
		$teacher = BankeTeachingTeacher::find($id);
		if ($teacher) {
			$user = BankeUserProfiles::find($teacher['uid']);
			$authen = new BankeUserAuthentication;
			$authen = $authen->find($teacher['uid']);
			if ($authen && $authen->count() > 0 && $authen['certification_status']==2) {
				$teacher['name'] = $authen['real_name'];
			}else{
				$teacher['name'] = $user['name'];
			}
			$teacher['mobile'] = $user['mobile'];
			$org = BankeOrg::find($teacher['org_id']);
			$teacher['org_name'] = $org['name'];
			$course = BankeCourse::find($teacher['course_id']);
			$teacher['course_name'] = $course['name'];
			$teacherArray = $teacher->toArray();
			return $teacherArray;
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
		$teacher = BankeTeachingTeacher::find($id);
		if ($teacher) {
			if ($teacher->fill($input)->save()) {
				if($input['status'] == config('admin.global.status.ban')){
					DB::beginTransaction();
					try {
						$user_profile = BankeUserProfiles::where('uid', $teacher['uid'])->lockForUpdate()->first();
						$user_profile->account_balance -= $teacher['award_amount'];
						$user_profile->save();

						$cur_user = Auth::user();
						$balance_log = [
							'uid'=>$teacher['uid'],
							'change_amount'=>$teacher['award_amount'],
							'change_type'=>'-',
							'business_type'=>'PUNISHMENT',
							'operator_uid'=>$cur_user['id']
						];
						//记录余额变动日志
						BankeBalanceLog::create($balance_log);
						DB::commit();
						Flash::success(trans('alerts.teacher.updated_success'));
						return true;
					} catch (Exception $e) {
						DB::rollback();
						Log::info($e);
						Flash::error(trans('alerts.teacher.updated_error'));
						return false;
					}
				}
				Flash::success(trans('alerts.teacher.updated_success'));
				return true;
			}else{
				Flash::error(trans('alerts.teacher.updated_error'));
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
		$teacher = BankeTeachingTeacher::find($id);
		if ($teacher) {
			$teacher->status = $status;
			if ($teacher->save()) {
				Flash::success(trans('alerts.teacher.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.teacher.updated_error'));
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
		$isDelete = BankeTeachingTeacher::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.teacher.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.teacher.deleted_error'));
		return false;
	}
}