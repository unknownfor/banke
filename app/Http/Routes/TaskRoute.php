<?php
/**
 * 新版任务路由
 */
$router->group(['prefix' => 'task'], function($router){
	$router->get('ajaxIndex', 'TaskController@ajaxIndex');
	$router->get('sort', 'TaskController@sort');
	$router->get('/{id}/mark/{status}', 'TaskController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('task', 'TaskController');