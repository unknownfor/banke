<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeCommentCourse;
use Carbon\Carbon;
use Flash;
use DB;
use App\Repositories\admin\AppUserRepository;
use League\Flysystem\Exception;
use App\Models\Banke\BankeMessage;

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
		$status = request('status' ,'');
		$comment = new BankeCommentCourse();
		$comment = $comment->where('course_id', $cid);

		/*奖励状态搜索*/
		if ($award_status) {
			$comment = $comment->where('award_status', $award_status);
		}

		/*状态搜索*/
		if ($status) {
			$comment = $comment->where('status', $status);
		}

		$count = $comment->count();

		$comment = $comment->offset($start)->limit($length);
		$comments = $comment->orderBy("id", "desc")->get();
               

		if ($comments) {
			foreach ($comments as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(true);
				$v['user_name']=$v->authenUser['real_name'];
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
		$org = BankeCommentCourse::find($id);
		if ($org) {
			$org['user_name']=$org->authenUser['real_name'];
			if(!$org['user_name']){
				$org['user_name']=$org->user['name'];
			}
			$org['org_name']=$org->org['name'];
			$orgArray = $org->toArray();
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
			$commentCourse=$commentCourse->fill($request->all());
			DB::transaction(function () use ($commentCourse,$request) {
				try {
					//TODO 审核通过加钱
					$this->awardUser($commentCourse, $request);
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
	private function awardUser($commentCourse,$request){
		if($this->isAward($commentCourse,$request)){
			$commentCourse=$commentCourse->course;
			$award=$commentCourse['comment_award'];  //当前机构的奖励金额
			if(!$award){
				$award=0;
			}
			$userRepository=new AppUserRepository;
			$userRepository->execUpdateUserAccountInfo($commentCourse['uid'],$award,1,4);  //更新用户账户金额信息以及添加变动记录

			//消息记录
			$message = [
				'status'=>1,
				'uid'=>$commentCourse['uid'],
				'title'=>'评论奖励',
				'content'=>'感谢您对机构"'.$commentCourse['name'].'" 的精彩评论,平台已奖励您' .$award.'元现金，快去现金钱包里查看吧！',
				'type'=>'COMMENT'
			];
			//记录消息
			BankeMessage::create($message);
		}
		return true;
	}

	//是否可以奖励 同一个人，一个个课程可以多次打赏
	private function isAward($commentCourse,$request){
		$flag1=$commentCourse['award_status']==0 && $request['award_status']==1;  //更新状态为奖励
		return $flag1;
	}

}