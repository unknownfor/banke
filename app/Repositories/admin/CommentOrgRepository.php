<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeCommentOrg;
use Carbon\Carbon;
use Flash;
use DB;
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
		$status = request('status' ,'');
		$comment = new BankeCommentOrg();
		$comment = $comment->where('org_id', $oid);

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
				$v['user_name']=$v->realUserInfo['real_name'];
				if(!$v['user_name']){
					$v['user_name']=$v->userInfo['name'];
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
			$comment['user_name']=$comment->realUserInfo['real_name'];
			if(!$comment['user_name']){
				$comment['user_name']=$comment->userInfo['name'];
			}
			$comment['org_name']=$comment->orgInfo['name'];
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
	public function update($request,$id)
	{
		$comment = BankeCommentOrg::find($id);
		if ($comment) {
			$comment=$comment->fill($request->all());
			DB::transaction(function () use ($comment) {
				//TODO 审核通过加钱
				if ($comment->save()) {
					Flash::success(trans('alerts.news.updated_success'));
					return $comment['org_id'];
				}
			});
			Flash::error(trans('alerts.news.updated_error'));
			return false;
		}
		abort(404);
	}

	/*奖励用户*/
	private function awardUser(){

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

}