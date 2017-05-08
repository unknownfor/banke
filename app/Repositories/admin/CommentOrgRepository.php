<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeCommentOrg;
use Carbon\Carbon;
use Flash;
use DB;
use App\Repositories\admin\AppUserRepository;
use League\Flysystem\Exception;
use App\Models\Banke\BankeMessage;

/**
* 机构评论
*/
class CommentOrgRepository
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
		
		$oid = request('oid' ,'');
		$award_status = request('award_status' ,'');
		$read_status = request('read_status' ,'');
		$comment = new BankeCommentOrg();

		if($oid!=null && $oid!='0') {
			$comment = $comment->where('org_id', $oid);
		}

		/*奖励状态搜索*/
		if ($award_status!=null) {
			$comment = $comment->where('award_status', $award_status);
		}

		/*阅读状态搜索*/
		if ($read_status!=null) {
			$comment = $comment->where('read_status', $read_status);
		}

		$count = $comment->count();

		$comment = $comment->offset($start)->limit($length);
		$comments = $comment->orderBy("id", "desc")->get();
               

		if ($comments) {
			foreach ($comments as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(true);
				$v['user_name']=$v->authenUser['real_name'];
				$v['org_name']=$v->org['name'];
				if(!$v['user_name']){
					$v['user_name']=$v->user['name'];
				}
			}
		}
               
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $comments,
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
		$comment = new BankeNews;
		if ($comment->fill($request->all())->save()) {
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
		$comment = BankeCommentOrg::find($id);
		if ($comment) {
			$comment['user_name']=$comment->authenUser['real_name'];
			if(!$comment['user_name']){
				$comment['user_name']=$comment->user['name'];
			}
			$comment['org_name']=$comment->org['name'];
			$comment['comment_award']=$comment->org['comment_award'];
			$commentArray = $comment->toArray();
			return $commentArray;
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
	public function updateComment($request,$id)
	{
		$comment = BankeCommentOrg::find($id);
		if ($comment) {
			DB::transaction(function () use ($comment,$request) {
				try {
					$oldAwardStatus=$comment['award_status'];
					$comment=$comment->fill($request->all());
					//TODO 审核通过加钱
					$this->awardUser($oldAwardStatus,$comment, $request);
					if ($comment->save()) {
						Flash::success(trans('alerts.org.updated_success'));
						return $comment['org_id'];
					}
				}catch (Exception $e){
					Flash::error(trans('alerts.app_user.certificate_error'));
					var_dump($e);
					return false;
				}
			});
			return $comment['org_id'];
		}else {
			abort(404);
		}
	}

	/*奖励用户*/
	private function awardUser($oldAwardStatus,$comment,$request){
		if($this->isAward($oldAwardStatus,$comment,$request)){
			$org=$comment->org;
			$comment_award=$org['comment_award'];  //当前机构的奖励金额
			if($comment_award) {
				AppUserRepository::execUpdateUserAccountInfo($comment['uid'], $comment_award, 1, 4);  //更新用户账户金额信息以及添加变动记录

				//消息记录
				$message = [
					'status' => 0,
					'uid' => $comment['uid'],
					'title' => '评论奖励',
					'content' => '感谢您对机构"' . $org['name'] . '" 的精彩评论,平台已奖励您' . $comment_award . '元现金，快去现金钱包里查看吧！',
					'type' => 'COMMENT'
				];
				//记录消息
				BankeMessage::create($message);
			}
		}
		return true;
	}

	//是否可以奖励 同一个人，同个机构只能打赏一次
	private function isAward($oldAwardStatus,$comment,$request){
		$flag1=$oldAwardStatus==0 && $request['award_status']==1;  //更新状态为奖励

		$org_id=$comment['org_id'];
		$uid=$comment['uid'];
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
		$comment = BankeNews::find($id);
		if ($comment) {
			$comment->status = $status;
			if ($comment->save()) {
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
		$commentOrg = BankeCommentOrg::find($id);
		$commentOrg->read_status=1;
		$commentOrg->save();
	}
}