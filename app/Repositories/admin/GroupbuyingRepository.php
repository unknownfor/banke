<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeGroupbuying;
use Carbon\Carbon;
use Flash;
use DB;
use League\Flysystem\Exception;
use App\Models\Banke\BankeMessage;

/**
* 团购列表
*/
class GroupbuyingRepository
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

		$course_id = request('course_id' ,'');
		$mobile = request('mobile' ,'');
		$groupbuying = new BankeGroupbuying();

		if($course_id!=null && $course_id!='0') {
			$groupbuying = $groupbuying->where('course_id', $course_id);
		}

		if($mobile!=null) {
			$groupbuying = $groupbuying->where('organizer_mobile', $mobile);
		}


		$count = $groupbuying->count();

		$groupbuying = $groupbuying->offset($start)->limit($length);
		$groupbuyings = $groupbuying->orderBy("id", "desc")->get();
               

		if ($groupbuyings) {
			foreach ($groupbuyings as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(true);
				$v['organizer_name']=$v->authenUser['real_name'];
				$v['course_name']=$v->course['name'];
				if(!$v['organizer_name']){
					$v['organizer_name']=$v->user['name'];
				}
			}
		}
               
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $groupbuyings,
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
		$groupbuying = new BankeNews;
		if ($groupbuying->fill($request->all())->save()) {
			Flash::success(trans('alerts.news.created_success'));
			return true;
		}
		Flash::error(trans('alerts.news.created_error'));
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
		$groupbuying = BankeCommentOrg::find($id);
		if ($groupbuying) {
			$groupbuying['user_name']=$groupbuying->authenUser['real_name'];
			if(!$groupbuying['user_name']){
				$groupbuying['user_name']=$groupbuying->user['name'];
			}
			$groupbuying['org_name']=$groupbuying->org['name'];
			$groupbuying['comment_award']=$groupbuying->org['comment_award'];
			$groupbuyingArray = $groupbuying->toArray();
			return $groupbuyingArray;
		}
		abort(404);
	}


	//是否可以奖励 同一个人，同个机构只能打赏一次
	private function isAward($oldAwardStatus,$groupbuying,$request){
		$flag1=$oldAwardStatus==0 && $request['award_status']==1;  //更新状态为奖励

		$org_id=$groupbuying['org_id'];
		$uid=$groupbuying['uid'];
		//同一个人，同个机构之前没有打赏过
		$flag2=BankeCommentOrg::where('uid',$uid)
				->where('org_id',$org_id)
				->where('award_status',1)->count()==0;

		return $flag1 && $flag2;
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
		$groupbuying = BankeNews::find($id);
		if ($groupbuying) {
			$groupbuying->status = $status;
			if ($groupbuying->save()) {
				Flash::success(trans('alerts.news.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.news.updated_error'));
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
		$isDelete = BankeNews::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.news.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.news.deleted_error'));
		return false;
	}

	/**
	 * 修改阅读状态
	 * @author jimmy
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public static function updateReadStatus($id)
	{
		$groupbuyingOrg = BankeCommentOrg::find($id);
		$groupbuyingOrg->read_status=1;
		$groupbuyingOrg->save();
	}


	/**
	 * 修改浏览量
	 * 如果浏览量  等于要求量，则息自动 进行奖励
	 * @author jimmy
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public static function updateViewCounts($id)
	{
		$groupbuying = BankeGroupbuying::lockForUpdate()->find($id);
		$max_finished_share_counts=$groupbuying->max_finished_share_counts;
		if($groupbuying['finished_share_counts']<$max_finished_share_counts){  //未完成 浏览量
			DB::transaction(function () use ($groupbuying) {
				try {
					$groupbuying->view_counts++;

					//达到浏览量
					if (($groupbuying->view_counts)%$groupbuying->min_view_counts==0) {
						$groupbuying->finished_share_counts ++ ;  //完成次数 + 1
						$that=new GroupbuyingRepository();
						$award=$that->getAward($groupbuying);  //获得奖励的钱
						$that->awardUser($groupbuying,$award);  //奖励相应
					}
					$groupbuying->save();
				}
				catch(Exception $e){
					Flash::error(trans('alerts.course.updated_error'));
					var_dump($e);
					return false;
				}
			});
			return true;
		}
		return false;
	}

	/*
	 * 获得奖励金额
	 * 最后一个奖励金额，会把剩余的钱都给用户
	 * @author jimmy
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	*/
	private function getAward($groupbuying){
		$award=0;
		$order = OrderRepository::getOrderByCouseIdAndUid($groupbuying->course_id, $groupbuying->organizer_id);
		if($groupbuying->finished_share_counts==$groupbuying->max_finished_share_counts) //最后一次
		{
			if($order){
				$award=$order->share_group_buying_amount - $order->get_share_group_buying_amount;  //剩余的钱
				if($award<0){
					$award=0;
				}
			}
		}
		else{
			$award = $groupbuying->min_view_counts; //金额和要求浏览次数1：1
		}
		$order->get_share_group_buying_amount+=$award;  //已经获得的分享金额+=$award
		$order->save();
		return $award;
	}

	/*奖励用户*/
	private function awardUser($groupbuying,$groupbuying_award){
		if($groupbuying_award) {
			AppUserRepository::execUpdateUserAccountInfo($groupbuying['organizer_id'], $groupbuying_award, 1, 6);  //更新用户账户金额信息以及添加变动记录

			//消息记录
			$message = [
				'status' => 0,
				'uid' => $groupbuying['organizer_id'],
				'title' => '评论奖励',
				'content' => '您分享的"' . $groupbuying->course['name'] . '" 浏览次数已经达到奖励标准,平台已奖励您' . $groupbuying_award . '元现金，快去现金钱包里查看吧！',
				'type' => config('admin.global.balance_log')[12]['key']
			];
			//记录消息
			BankeMessage::create($message);
		}
		return true;
	}

	public static function getAllMembersByGroupbuyingId($id)
	{

	}
}