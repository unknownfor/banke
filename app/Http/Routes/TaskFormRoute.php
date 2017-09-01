<?php
/**
 * 新版任务期数路由
 */
$router->group(['prefix' => 'taskform'], function($router){
	$router->get('ajaxIndex', 'TaskFormController@ajaxIndex');
	$router->get('sort', 'TaskFormController@sort');
	$router->get('/{id}/mark/{status}', 'TaskFormController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('taskform', 'TaskFormController');