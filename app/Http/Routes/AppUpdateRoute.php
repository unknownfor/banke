<?php
/**
 * 角色路由
 */
$router->group(['prefix' => 'appUpdate'], function($router){
	$router->get('ajaxIndex', 'AppUpdateController@ajaxIndex');
	$router->get('/{id}/mark/{status}', 'AppUpdateController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('appUpdate', 'AppUpdateController');