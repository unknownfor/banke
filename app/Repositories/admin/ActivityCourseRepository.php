<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeActivityCourse;
use Carbon\Carbon;
use Flash;
use DB;
/**
* 参与活动课程仓库
*/
class ActivityCourseRepository
{
	/**
	 * 添加活动对应课程 批量
	 * @author shaolei
	 * @date   2016-04-13T11:50:22+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function storeMultiple($activity_id,$course_arr)
	{
		//事务
		DB::transaction( function () use ($activity_id,$course_arr) {
			try {
				BankeActivityCourse::where('activity_id', $activity_id)->delete();  //删除现有的

				$arr = [];
				foreach ($course_arr as $v) {
					$temp_arr = [
						'activity_id' => $activity_id,
						'course_id' => $v
					];
					array_push($arr, $temp_arr);
				}

				if (DB::table('banke_activity_course')->insert($arr)) {
//					Flash::success(trans('alerts.activity.created_success'));
					return true;
				}
			} catch (Exception $e) {
//				Flash::error(trans('alerts.activity.created_error'));
				return false;
			}
		});
	}


	/*
	 * 得到活动和课程相关联信息
	 */
	public function getAllCouseIdArrByActivityId($activity_id){
		$course_arr = BankeActivityCourse::where('activity_id', $activity_id)->get()->toArray();
		$arr=[];
		foreach($course_arr as $v){
			array_push($arr,$v['course_id']);
		}
		return $arr;
	}
}