<?php
/**
 * 课程路由
 */
$router->group(['prefix' => 'course'], function($router){
	$router->get('ajaxIndex', 'CourseController@ajaxIndex');
	$router->get('sort', 'CourseController@sort');
	$router->get('/{id}/mark/{status}', 'CourseController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
	//根据机构搜索课程
	$router->get('search_by_org', 'CourseController@search_by_org');

	//根据机构搜索课程
	$router->get('getSecondCategoryByOrg', 'CourseController@getSecondCategoryByOrg');
});

$router->resource('course', 'CourseController');