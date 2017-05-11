<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeTrainCategory;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeOrg;
use App\Models\Banke\BankeOrgCategory;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Array_;

/**
* 机构仓库
*/
class OrgRepository
{
	/**
	 * datatable获取数据
	 * @author shaolei
	 * @date   2016-04-13T21:14:37+0800
	 * @return [type]                   [description]
	 */
	public function ajaxIndex()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.global.list.start')); /*获取开始*/
		$length = request('length', config('admin.global.list.length')); ///*获取条数*/

		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/

		$name =request('name' ,'');
		$city =request('city' ,'');
		$status = request('status' ,'');

		$org = new BankeOrg;

		/*机构名称搜索*/
		if($name){
			if($search_pattern){
				$org = $org->where('name', 'like', $name);
			}else{
				$org = $org->where('name', $name);
			}
		}

		/*城市搜索*/
		if($city){
			if($search_pattern){
				$org = $org->where('city', 'like', $city);
			}else{
				$org = $org->where('city', $city);
			}
		}

		/*状态搜索*/
		if ($status!=null) {
			$org = $org->where('status', $status);
		}

		$count = $org->count();

		$org = $org->offset($start)->limit($length);
		$orgs = $org->orderBy("id", "desc")->get();

		if ($orgs) {
			foreach ($orgs as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
//				$categories=$v->categories;
//				if($categories)
//				$v['category'] = $categories;
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $orgs,
		];
	}

	/**添加机构
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$org = new BankeOrg;
		if ($org->fill($request->all())->save()) {
			Flash::success(trans('alerts.org.created_success'));
			return $org->id;
		}
		Flash::error(trans('alerts.org.created_error'));
		return false;
	}

	/**
	 * 修改机构视图
	 * @author shaolei
	 * @date   2016-04-13T11:50:34+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$role = BankeOrg::find($id);
		if ($role) {
			$roleArray = $role->toArray();
			return $roleArray;
		}
		abort(404);
	}

	/**
	 * 查看机构信息
	 * @author 晚黎
	 * @date   2016-04-13T17:09:22+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		$org = BankeOrg::find($id)->toArray();
		return $org;
	}

	/**
	 * 修改机构
	 * @author shaolei
	 * @date   2016-04-13T11:50:46+0800
	 * @param  [type]                   $request [description]
	 * @param  [type]                   $id      [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$role = BankeOrg::find($id);
		if ($role) {
			if ($role->fill($request->all())->save()) {
				Flash::success(trans('alerts.org.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.org.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 修改机构状态
	 * @author shaolei
	 * @date   2016-04-13T11:51:02+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function mark($id,$status)
	{
		$org = BankeOrg::find($id);
		if ($org) {
			$org->status = $status;
			if ($org->save()) {
				Flash::success(trans('alerts.org.updated_success'));
				return $org->id;
			}
			Flash::error(trans('alerts.org.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 删除机构
	 * @author shaolei
	 * @date   2016-04-13T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$isDelete = BankeOrg::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.org.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.org.deleted_error'));
		return false;
	}

	/**
	 * 前几个机构
	 * @author jimmy
	 * @date   2017-02-23T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function getTop($num)
	{
		$org = new BankeOrg;
		$org = $org->where('status', 1);
		$org = $org->offset(0)->limit($num);
		$orgs = $org->get()->all();
		return $orgs;
	}

	/**
	 * 机构具体信息
	 * @author jimmy
	 * @date   2017-02-23T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function getDetail($id)
	{
		$org = new BankeOrg;
		$org = $org->find($id);
		if ($org) {
			foreach ($org as &$v) {
				$v['course'] = $v->course()->where('status', 1);
			}
		}
		$orgs = $org->get()->all();
		return $orgs;
	}

	/**
	 * 机构的所属分类
	 * @author jimmy
	 * @date   2017-02-23T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function  getCategoryInfo($id)
	{
		$arr=Array();
		$myCategories = BankeOrgCategory::where('oid',$id)->get();  //机构分类关联表
		if ($myCategories) {
			foreach ($myCategories as &$v) {
				array_push($arr,$v['cid']);
			}
		}

		$categories=BankeTrainCategory::whereIn('id',$arr)->get();
		return $categories;
	}

	/**
	 * 机构的所属分类 一级
	 * @author jimmy
	 * @date   2017-02-23T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function  getCategory1Info($id)
	{
		$allCategories = BankeTrainCategory::where('pid', 0)->get();  //所有顶级分类关联表
		$myCategories = BankeOrgCategory::where('oid', $id)->get();  //机构分类关联表
		return $this->setUpCategoryInfo($allCategories,$myCategories);
	}

	/**
	 * 机构的所属分类 二级
	 * @author jimmy
	 * @date   2017-02-23T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function  getCategory2Info($id)
	{
		$arr=Array();
		$myCategories = BankeOrgCategory::where('oid',$id)->get();  //机构分类关联表,包括顶级和二级
		if ($myCategories) {
			foreach ($myCategories as &$v) {
				array_push($arr,$v['cid']);
			}
		}
		$allCategories=BankeTrainCategory::whereIn('id',$arr)->where('pid',0)->get();
		$arr2=Array();
		if ($allCategories) {

			foreach ($allCategories as &$v) {
				array_push($arr2,$v['id']);
			}
		}
		$tempCategories=BankeTrainCategory::whereIn('pid',$arr2)->get();  //我的二级分类以及它的兄弟分类
		return $this->setUpCategoryInfo($tempCategories,$myCategories);
	}


	/**
	 * 机构的所属分类处理
	 */
	public function  setUpCategoryInfo($allCategories,$myCategories)
	{
		$arr=Array();
		if ($allCategories) {
			foreach ($allCategories as &$v) {
				$flag=$this->inInArray($v['id'],$myCategories);
				$tempArr=Array('id'=>$v['id'],'name'=>$v['name'],'flag'=>$flag);
				array_push($arr,$tempArr);
			}
		}
		return $arr;
	}

	private  function inInArray($id,$arr){
		if ($arr) {
			foreach ($arr as &$v) {
				if($id==$v['cid']){
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * 机构的所属分类 一级  查看页面时调用
	 * @author jimmy
	 * @date   2017-02-23T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function  getCategory1InfoRead($id)
	{
		$arr=Array();
		$myCategories = BankeOrgCategory::where('oid',$id)->get();  //机构分类关联表
		if ($myCategories) {
			foreach ($myCategories as &$v) {
				array_push($arr,$v['cid']);
			}
		}
		$categories=BankeTrainCategory::whereIn('id',$arr)->where('pid',0)->get();
		return $categories;
	}
	/**
	 * 机构的所属分类 二级 查看页面时调用
	 * @author jimmy
	 * @date   2017-02-23T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function  getCategory2InfoRead($id)
	{
		$arr=Array();
		$myCategories = BankeOrgCategory::where('oid',$id)->get();  //机构分类关联表
		if ($myCategories) {
			foreach ($myCategories as &$v) {
				array_push($arr,$v['cid']);
			}
		}
		$categories=BankeTrainCategory::whereIn('id',$arr)->where('pid','<>',0)->get();
		return $categories;
	}



	/**
	 * 机构的所属分类 ids
	 * @author jimmy
	 * @date   2017-02-23T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function  getTrainCategoryIds($id)
	{
		$arr=Array();
		$myCategories = BankeOrgCategory::where('oid',$id)->get();
		if ($myCategories) {
			foreach ($myCategories as &$v) {
				array_push($arr,$v['cid']);
			}
		}
		return$arr;
	}


	/**
	 * 机构的所属分类 ids
	 * @author jimmy
	 * @date   2017-02-23T11:51:19+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function  getTags($id)
	{
		$arr=Array();
		$tags=BankeOrg::find($id)->tags;
		if ($tags) {
			foreach ($tags as &$v) {
				array_push($arr,$v['name']);
			}
		}
		return$arr;
	}
}