<?php
/**
 * app弹窗提示路由
 */
$router->group(['prefix' => 'alertbox'], function($router){
	$router->get('ajaxIndex', 'AlertBoxController@ajaxIndex');
	$router->get('/{id}/mark/{status}', 'AlertBoxController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('alertbox', 'AlertBoxController');