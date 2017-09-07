<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeCommentAppStore;
use App\Models\Banke\BankeDict;
use Carbon\Carbon;
use Flash;
use DB;
use League\Flysystem\Exception;
use App\Models\Banke\BankeMessage;
use AppUserRepository;
use Auth;

/**
* app store 评论
*/
class CommentAppStoreRepository
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

		$certification_status = request('certification_status' ,'');
		$comment = new BankeCommentAppStore();

		/*奖励状态搜索*/
		if ($certification_status!=null) {
			$comment = $comment->where('certification_status', $certification_status);
		}

		$count = $comment->count();

		$comment = $comment->offset($start)->limit($length);
		$comments = $comment->orderBy("id", "desc")->get();
               

		if ($comments) {
			foreach ($comments as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(true);
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
		$comment = BankeCommentAppStore::find($id);
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
	 * 审核评论
	 * @author jimmy
	 * @date   2016-04-13T11:51:02+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function certificate($id,$status)
	{
		$commentApp = BankeCommentAppStore::find($id);
		if ($commentApp) {
			if ($commentApp['certification_status'] == config('admin.global.status.active')) {
				Flash::error(trans('alerts.common.already_active'));
				return false;
			}
			else {
				DB::transaction(function () use ($commentApp, $status) {
					try {
						$cur_user = Auth::user();
						$commentApp->operator_id=$cur_user->id;
						$commentApp->certification_status=$status;

						//奖励
						if ($status == config('admin.global.status.active')) {
							$this->award_user($commentApp->uid);//奖励用户

						}
						$commentApp->save();
						DB::commit();
						Flash::success(trans('alerts.commentappstore.updated_success'));
						return true;
					} catch (Exception $e) {
						Flash::error(trans('alerts.commentappstore.updated_error'));
						var_dump($e);
						return false;
					}
				});
			}
		}else {
			abort(404);
		}
	}

	/**
	 * 奖励用户
	 * 通过认证后，给奖励
	 * @author jimmy
	 * @date   2017-08-04T11:42:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	private function award_user($uid)
	{
		$award = BankeDict::find(18)->value;
		AppUserRepository::execUpdateUserAccountInfo($uid,$award,1,8);

		//奖励信息添加添加到message表中
		$message = [
			'uid' => $uid,
			'title' => '半课好评奖励',
			'content' => '感谢您对半课的好评,平台奖励您' . $award . '元现金，快去现金钱包里查看吧！',
			'type' => config('admin.global.balance_log')[15]['key']
		];
		//记录消息
		BankeMessage::create($message);
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
		$commentCourse = BankeCommentAppStore::find($id);
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

}