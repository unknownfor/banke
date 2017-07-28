<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeTeachingTeacher;
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
			$teacher = $teacher->where('name','like','%'.$name.'%');
		}

		/*子机构id搜索*/
		if($sub_org_id!=null){
			$teacher = $teacher->where('sub_org_id',$sub_org_id);
		}

		/*状态搜索*/
		if($status!=null){
			$teacher = $teacher->where('status',$status);
		}

		$count = $teacher->count();

		$teacher = $teacher->offset($start)->limit($length);
		$teachers = $teacher->orderBy("id", "desc")->get();

		if ($teachers) {
			foreach ($teachers as &$v) {
				$org=$v->org;
				if($org) {
					$v['sub_org'] = $org->name;
				}
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
			Flash::success(trans('alerts.teachingteacher.created_success'));
			return true;
		}
		Flash::error(trans('alerts.teachingteacher.created_error'));
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
		$role = BankeTeachingTeacher::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.teachingteacher.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.teachingteacher.updated_error'));
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
		$teacher = BankeTeachingTeacher::find($id);
		if ($teacher) {
			$teacher->status = $status;
			if ($teacher->save()) {
				Flash::success(trans('alerts.teachingteacher.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.teachingteacher.updated_error'));
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
			Flash::success(trans('alerts.teachingteacher.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.teachingteacher.deleted_error'));
		return false;
	}
}