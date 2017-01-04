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
});

$router->resource('course', 'CourseController');