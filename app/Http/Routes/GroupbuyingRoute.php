<?php
/**
 * 开团路由
 */
$router->group(['prefix' => 'groupbuying'], function($router){
	$router->get('ajaxIndex', 'GroupbuyingController@ajaxIndex');
	$router->get('sort', 'GroupbuyingController@sort');
	$router->get('/{id}/mark/{status}', 'GroupbuyingController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.ban').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('groupbuying', 'GroupbuyingController');