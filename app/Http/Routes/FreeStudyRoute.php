<?php
/**
 * 免费学路由
 */
$router->group(['prefix' => 'freestudy'], function($router){
	$router->get('ajaxIndex', 'FreeStudyController@ajaxIndex');
	$router->get('sort', 'FreeStudyController@sort');
	$router->get('/{id}/mark/{status}', 'FreeStudyController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
	$router->get('users/{id}', 'FreeStudyController@users');
	$router->get('ajaxUsersIndex', 'FreeStudyController@ajaxUsersIndex');
});

$router->resource('freestudy', 'FreeStudyController');