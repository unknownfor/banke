<?php
/**
 * 机构路由
 */
$router->group(['prefix' => 'order'], function($router){
	$router->get('ajaxIndex', 'OrderController@ajaxIndex');
	$router->get('sort', 'OrderController@sort');
	$router->get('/{id}/mark/{status}', 'OrderController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
	$router->get('ajaxCheck', 'OrderController@ajaxCheck');
	$router->get('check', 'OrderController@check');

	//手机号查询
	$router->post('/search_by_mobile','OrderController@search_by_mobile');

});

$router->resource('order', 'OrderController');