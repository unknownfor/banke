<?php
/**
 * 新版一期任务路由
 */
$router->group(['prefix' => 'taskformdetail'], function($router){
	$router->get('ajaxIndex', 'TaskFormDetailController@ajaxIndex');
	$router->get('sort', 'TaskFormDetailController@sort');
	$router->get('/{id}/mark/{status}', 'TaskFormDetailController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('taskformdetail', 'TaskFormDetailController');