<?php
/**
 * 角色路由
 */
$router->group(['prefix' => 'enrol'], function($router){
	$router->get('ajaxIndex', 'EnrolController@ajaxIndex');
	$router->get('/{id}/mark/{status}', 'EnrolController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
	//发送短信通知
	$router->post('sendmsg','EnrolController@sendmsg');
});

$router->resource('enrol', 'EnrolController');