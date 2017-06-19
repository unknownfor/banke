<?php
/**
 * 订金路由
 */
$router->group(['prefix' => 'orderdeposit'], function($router){
	$router->get('ajaxIndex', 'OrderDepositController@ajaxIndex');
	$router->get('sort', 'OrderDepositController@sort');
	$router->get('/{id}/mark/{status}', 'OrderDepositController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
	$router->get('ajaxCheck', 'OrderDepositController@ajaxCheck');
});

$router->resource('orderdeposit', 'OrderDepositController');