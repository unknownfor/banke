<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeMoneyNews;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeUserProfiles;
use Carbon\Carbon;
use Flash;
use UserRepository;
/**
* 赚钱动态仓库
*/
class MoneyNewsRepository
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
		$news = new BankeMoneyNews;


		/*状态搜索*/
		if ($status !=null ) {
			$news = $news->where('status', $status);
		}


		$count = $news->count();


		$news = $news->offset($start)->limit($length);
		$news = $news->orderBy("id", "desc")->get();
               

		if ($news) {
			foreach ($news as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
			}
		}
               
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $news,
		];
	}

	/**
	 * 添加赚钱动态
	 * @author shaolei
	 * @date   2016-04-13T11:50:22+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{   
		$news = new BankeMoneyNews;
		$input=$request->all();
		$org=BankeOrg::find($input['org_id']);
		$input['short_name']=$org['short_name'];
		if ($news->fill($input)->save()) {
			Flash::success(trans('alerts.moneynews.created_success'));
			return true;
		}
		Flash::error(trans('alerts.moneynews.created_error'));
		return false;
	}
	/**
	 * 修改赚钱动态视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$news = BankeMoneyNews::find($id);
		if ($news) {
			$newsArray = $news->toArray();
			return $newsArray;
		}
		abort(404);
	}
	/**
	 * 修改赚钱动态
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$news = BankeMoneyNews::find($id);
		$input=$request->all();
		$org=BankeOrg::find($input['org_id']);
		$input['short_name']=$org['short_name'];
		if ($news) {
			if ($news->fill($input)->save()) {
				Flash::success(trans('alerts.moneynews.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.moneynews.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 修改赚钱动态状态
	 * @author shaolei
	 * @date   2016-04-13T11:51:02+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function mark($id,$status)
	{
		$news = BankeMoneyNews::find($id);
		if ($news) {
			$news->status = $status;
			if ($news->save()) {
				Flash::success(trans('alerts.moneynews.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.moneynews.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除赚钱动态
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeMoneyNews::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.moneynews.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.moneynews.deleted_error'));
		return false;
	}

	/*将系统自动生成的 赚钱动态添加到表中，目前主要有
	 * 1：老师邀请学生报名
	 * 2：学生邀请好友报名
	 * 3: 学生报名
	 * 4：打卡（客户端产生）
	 * 5：开团分享
	 * [
			'INVITE_STUDENT_ENROL_SUCCESS' => '老师邀请学生报名',
			'INVITE_FRIEND_ENROL_SUCCESS' => '学生邀请好友报名',
			'ENROL_SUCCESS' => '报名',
			'CHECK_IN_SUCCESS' => '打卡奖励',
			'SHARE_GROUP_BUYING'=>'开团分享'
		],
	 *
	*/
	public static function addRecordToMeoneyNewsFromSystem($info){
		$business_type=$info['business_type'];
			$news = new BankeMoneyNews;
			$userInfo=UserRepository::getUserSimpleInfoById($info['uid']);
			$user_type =0;
			if($userInfo['user_type']>2){
				$user_type=1;
			}
			$news->user_name =$userInfo['name'];
			$news->user_type =$user_type;
			$news->business_type=$info['business_type'];
			$news->amount=$info['amount'];
			$news->org_id=$info['org_id'];

			if(strpos($business_type,'INVITE')>=0) {
				$news->cut_amount = $info['cut_amount'];
				$news->invited_name = UserRepository::getUserSimpleInfoById($info['invited_uid'])['name'];;
			}

			$org = BankeOrg::find($news['org_id']);
			$news->short_name = $org['short_name'];

			if ($news->save()) {
				Flash::success(trans('alerts.moneynews.created_success'));
				return true;
			}
			Flash::error(trans('alerts.moneynews.created_error'));
			return false;
		}
}