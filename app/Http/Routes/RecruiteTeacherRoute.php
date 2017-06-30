<?php
/**
 * 招生老师路由
 */
$router->group(['prefix' => 'recruiteteacher'], function($router){
	$router->get('ajaxIndex', 'RecruiteTeacherController@ajaxIndex');
	$router->get('sort', 'RecruiteTeacherController@sort');
	$router->get('/{id}/mark/{status}', 'RecruiteTeacherController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('recruiteteacher', 'RecruiteTeacherController');