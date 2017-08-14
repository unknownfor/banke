<?php
/**
 * 免费学成员路由
 */
$router->group(['prefix' => 'freestudyusers'], function($router){
	$router->get('ajaxIndex', 'FreeStudyUsersController@ajaxIndex');
	$router->get('sort', 'FreeStudyUsersController@sort');
	$router->get('/{id}/mark/{status}', 'FreeStudyUsersController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('freestudyusers', 'FreeStudyUsersController');