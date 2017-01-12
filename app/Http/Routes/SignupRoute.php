<?php
/**
 * 机构路由
 */
$router->group(['prefix' => 'signup'], function($router){
	$router->get('ajaxIndex', 'SignupController@ajaxIndex');
	$router->get('sort', 'SignupController@sort');
	$router->get('/{id}/mark/{status}', 'SignupController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('signup', 'SignupController');