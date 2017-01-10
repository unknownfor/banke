<?php
/**
 * 提现路由
 */
$router->group(['prefix' => 'checkins'], function($router){
	$router->get('ajaxIndex', 'CheckinsController@ajaxIndex');
	$router->get('sort', 'CheckinsController@sort');
	$router->get('/{id}/mark/{status}', 'CheckinsController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('checkins', 'CheckinsController');