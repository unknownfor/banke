<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeOrgCategory;
use Illuminate\Support\Facades\Log;
use DB;
/**
* 机构分类仓库
*/
class OrgCategoryRepository
{

	/**添加机构分类
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($request)
	{
		$cate = new BankeOrgCategory();
		if ($cate->fill($request->all())->save()) {
			Flash::success(trans('alerts.orgcategory.created_success'));
			return true;
		}
		Flash::error(trans('alerts.orgcategory.created_error'));
		return false;
	}

	/**批量更新机构分类
	 * 基本逻辑是 将原来的全部删除，然后添加新的
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function batchStore($category,$oid)
	{
		//事务
		DB::transaction( function () use ($category,$oid){
			try {
				BankeOrgCategory::where('oid', $oid)->delete();  //删除现有的

				//添加新的
				$arr = Array();
				foreach ($category as $val) {
					$tempaArr = Array('oid' => $oid, 'cid' => $val);
					Array_push($arr, $tempaArr);
				}
				DB::table('banke_org_category')->insert($arr);
				return true;
			} catch (Exception $e) {
				Flash::error(trans('alerts.order.created_error'));
				return false;
			}
		});
	}
}