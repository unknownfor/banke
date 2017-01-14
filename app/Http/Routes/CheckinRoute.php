<?php
/**
 * 提现路由
 */
$router->group(['prefix' => 'checkin'], function($router){
	$router->get('ajaxIndex', 'CheckinController@ajaxIndex');
	$router->get('sort', 'CheckinController@sort');
	$router->get('/{id}/mark/{status}', 'CheckinController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('checkin', 'CheckinController');