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


	/**添加课程分类
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function store($category_id,$id)
	{
		$category = new BankeCourseCategory;
		$category->course_id=$id;
		$category->cid=$category_id;
		if ($category->save()) {
			Flash::success(trans('alerts.course.created_success'));
			return $category->id;
		}
		Flash::error(trans('alerts.org.created_error'));
		return false;
	}

	/**更新课程分类
	 * @author shaolei
	 * @date   2016-04-14T11:32:04+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function update($category_id,$id)
	{
		$category = BankeCourseCategory::where('course_id',$id)->first();
		if ($category) {
			$category->cid = $category_id;
			if ($category->save()) {
				Flash::success(trans('alerts.course.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.course.updated_error'));
			return false;
		}else{
			return $this->store($category_id,$id);

		}
		abort(404);
	}
}