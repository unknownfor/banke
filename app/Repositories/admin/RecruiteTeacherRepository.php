<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeRecruiteTeacher;
use App\Models\Banke\BankeRecruiteTeacherApplyFor;
use App\Models\Banke\BankeDict;
use AppUserRepository;
use Carbon\Carbon;
use Flash;
/**
* 招生老师仓库
*/
class RecruiteTeacherRepository
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

		$status = request('status' ,'');
		$teacher = new BankeRecruiteTeacher;


		/*状态搜索*/
		if ($status) {
			$teacher = $teacher->where('status', $status);
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
	 * 添加招生老师申请
	 * @author shaolei
	 * @date   2016-04-13T11:50:22+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function register($userData)
	{
		$teacher = [
			'mobile'=>$userData['mobile'],
			'invitation_uid'=>$userData['invitation_uid'],
		];
		BankeRecruiteTeacherApplyFor::create($teacher);
		return true;
	}
	/**
	 * 修改招生老师视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$teacher = BankeRecruiteTeacher::find($id);
		if ($teacher) {
			$teacherArray = $teacher->toArray();
			return $teacherArray;
		}
		abort(404);
	}
	/**
	 * 修改招生老师
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$teacher = BankeRecruiteTeacher::find($id);
		if ($teacher) {
			$input = $request->all();
			//奖励邀请人
			if ($input['status'] == 1) {
				self::awardInvitor($teacher);
			}
			if ($teacher->fill($request->all())->save()) {
				Flash::success(trans('alerts.recruiteteacher.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.recruiteteacher.updated_error'));
			return false;
		}
		abort(404);
	}

	//奖励邀请人
	private static function awardInvitor($teacher)
	{
		$mobile = $teacher->userSimple['mobile'];
		$applyFor = BankeRecruiteTeacherApplyFor::where('mobile',$mobile);
		if($applyFor->count()>0){
			$applyFor = $applyFor->first();
			$invitation_uid=$applyFor['invitation_uid'];

			//查询系统配置里注册认证的奖金
			$register_award = BankeDict::where('id', 1)->first();
			AppUserRepository::execUpdateUserAccountInfo($invitation_uid, $register_award, 1, 2);
		}
	}

	/**
	 * 删除招生老师
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeRecruiteTeacher::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.recruiteteacher.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.recruiteteacher.deleted_error'));
		return false;
	}

}