<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeOrgSummaryTags;
use Carbon\Carbon;
use Flash;
use Illuminate\Support\Facades\Log;
use DB;
/**
* 机构总表标签
*/
class OrgSummaryTagsRepository
{

	/**批量更新机构标签
	 * 基本逻辑是 将原来的全部删除，然后添加新的
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function batchStore($tags,$oid)
	{
		//事务
		DB::transaction( function () use ($tags,$oid){
			try {
				BankeOrgSummaryTags::where('oid', $oid)->delete();  //删除现有的

				if($tags) {
					$tags = explode(',', $tags);
					//添加新的
					if (Count($tags) > 0) {
						$arr = Array();
						foreach ($tags as $val) {
							$tempaArr = Array('oid' => $oid, 'name' => $val);
							Array_push($arr, $tempaArr);
						}
						DB::table('banke_org_summary_tags')->insert($arr);
					}
				}
				return true;
			} catch (Exception $e) {
				Flash::error(trans('alerts.org_summary.created_error'));
				return false;
			}

		});
	}
}