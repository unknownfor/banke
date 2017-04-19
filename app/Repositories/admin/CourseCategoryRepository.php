<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeCourseCategory;
use Carbon\Carbon;
use Flash;
use Illuminate\Support\Facades\Log;
use DB;
/**
* 课程分类仓库
*/
class CourseCategoryRepository
{

	/**更新课程分类
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function update($category_id,$id)
	{
		$category = BankeCourseCategory::where('course_id',$id);
		if ($category) {
			$category->cid = $category_id;
			if ($category->save()) {
				Flash::success(trans('alerts.course.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.course.updated_error'));
			return false;
		}
		abort(404);
	}
}