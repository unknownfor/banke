<?php
/**
 * 活动路由
 */
$router->group(['prefix' => 'teachingteacher'], function($router){
	$router->get('ajaxIndex', 'TeachingTeacherController@ajaxIndex');
	$router->get('sort', 'TeachingTeacherController@sort');
	$router->get('/{id}/mark/{status}', 'TeachingTeacherController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('teachingteacher', 'TeachingTeacherController');