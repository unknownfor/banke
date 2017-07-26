<?php
/**
 * 活动路由
 */
$router->group(['prefix' => 'activity'], function($router){
	$router->get('ajaxIndex', 'ActivityController@ajaxIndex');
	$router->get('sort', 'ActivityController@sort');
	$router->get('/{id}/mark/{status}', 'ActivityController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('activity', 'ActivityController');