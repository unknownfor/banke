<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeCashBackUser;
use App\Models\Banke\BankeCommentCourse;
use Carbon\Carbon;
use Flash;
use DB;
use App\Repositories\admin\AppUserRepository;
use League\Flysystem\Exception;
use App\Models\Banke\BankeMessage;
use App\Models\Banke\BankeOrg;

/**
* 课程评论
*/
class CommentCourseRepository
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
		
		$cid = request('cid' ,'');
		$award_status = request('award_status' ,'');
		$read_status = request('read_status' ,'');
		$comment = new BankeCommentCourse();

		if($cid!=null && $cid!='0') {
			$comment = $comment->where('course_id', $cid);
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
				$v['course_name']=$v->course['name'];
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
	 * 修改配置视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$comment = BankeCommentCourse::find($id);
		if ($comment) {
			$comment['user_name']=$comment->authenUser['real_name'];
			if(!$comment['user_name']){
				$comment['user_name']=$comment->user['name'];
			}
			$comment['course_name']=$comment->course['name'];
			$comment['comment_award']=$comment->course['comment_award'];
			$orgArray = $comment->toArray();
			return $orgArray;
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
		$commentCourse = BankeCommentCourse::find($id);
		if ($commentCourse) {
			DB::transaction(function () use ($commentCourse,$request) {
				try {
					$oldAwardStatus=$commentCourse['award_status'];
					$commentCourse=$commentCourse->fill($request->all());

					// 审核通过加钱
					$this->awardUser($oldAwardStatus,$commentCourse, $request);
					if ($commentCourse->save()) {
						Flash::success(trans('alerts.course.updated_success'));
						return $commentCourse['course_id'];
					}
				}catch (Exception $e){
					Flash::error(trans('alerts.course.updated_error'));
					var_dump($e);
					return false;
				}
			});
			return $commentCourse['course_id'];
		}else {
			abort(404);
		}
	}

	/*奖励用户*/
	private function awardUser($oldAwardStatus,$comment,$request,$comment_award){
		if($this->isAward($oldAwardStatus,$request)){
			$course=$comment->course;
			if(!$comment_award) {
				$comment_award = $course['comment_award'];  //当前课程的奖励金额,v1.5 不是固定的，而是动态计算得到
			}
			if($comment_award) {
				AppUserRepository::execUpdateUserAccountInfo($comment['uid'], $comment_award, 1, 5);  //更新用户账户金额信息以及添加变动记录

				//消息记录
				$message = [
					'status' => 0,
					'uid' => $comment['uid'],
					'title' => '评论奖励',
					'content' => '感谢您对课程"' . $course['name'] . '" 的精彩评论,平台已奖励您' . $comment_award . '元现金，快去现金钱包里查看吧！',
					'type' => config('admin.global.balance_log')[11]['key']
				];
				//记录消息
				BankeMessage::create($message);
			}
		}
		return true;
	}

	//一个课程可以多次打赏
	private function isAward($oldAwardStatus,$request){
		$flag1=$oldAwardStatus==0 && $request['award_status']==1;  //更新状态为奖励
		return $flag1;
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
		$commentCourse = BankeCommentCourse::find($id);
		$commentCourse->read_status=1;
		$commentCourse->save();
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
		$commentCourse = BankeCommentCourse::lockForUpdate()->find($id);
		if(!$commentCourse->view_counts_flag){  //未完成 浏览量
			DB::transaction(function () use ($commentCourse) {
				try {
					$commentCourse->view_counts++;

					//达到浏览量
					if ($commentCourse->view_counts == $commentCourse->min_view_counts) {
						$commentCourse->view_counts_flag = true;  //标志已经达到浏览量

						//奖励
						$oldAwardStatus = $commentCourse['award_status'];
						$request = array('award_status' => 1);

						$that=new CommentCourseRepository();

						$comment_award=$that->getAward($commentCourse);  //奖励金额
						$that->awardUser($oldAwardStatus, $commentCourse, $request,$comment_award);  //奖励相应
						$commentCourse->award_status=1;
					}
					$commentCourse->save();
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
	private function getAward($comment){
		$award=0;
		$course_id=$comment->course_id;
		$uid= $comment->uid;
		$order = OrderRepository::getOrderByCouseIdAndUid($course_id, $uid);

//		已经完成几次
		$finished_times=BankeCommentCourse::where(['course_id'=>$course_id,'uid'=>$uid,'view_counts_flag'=>1])->count();

		if($finished_times==$order->share_comment_course_counts-1) //最后一次
		{
			if($order){
				$award=$order->share_comment_course_amount - $order->get_share_comment_course_amount;  //剩余的钱
				if($award<0){
					$award=0;
				}
			}
		}
		else{
			$award = $comment->min_view_counts; //金额和要求浏览次数1：1
		}
		$order->get_share_comment_course_amount+=$award;  //已经获得的分享金额+=$award
		$order->save();
		return $award;
	}


	/**
	 * 根据机构id得到心得的浏览量
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public static function getViewsCountsByOrgId($oid)
	{
		$allCourse=BankeOrg::find($oid)->course;
		$counts=0;
		foreach($allCourse as $v){
			$comment=$v->commnents;
			$tempCounts=0;
			foreach($comment as $c) {
				$tempCounts = $c->view_counts;
				$counts+=$tempCounts;
			}
		}
		return $counts;

	}
}