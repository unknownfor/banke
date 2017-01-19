<?php
/**
 * 提现路由
 */
$router->group(['prefix' => 'withdraw'], function($router){
	$router->get('ajaxIndex', 'WithdrawController@ajaxIndex');
	$router->get('sort', 'WithdrawController@sort');
	$router->get('/{id}/mark/{status}', 'WithdrawController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.ban').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('withdraw', 'WithdrawController');