<?php
/**
 * 提现路由
 */
$router->group(['prefix' => 'cash'], function($router){
	$router->get('ajaxIndex', 'CashController@ajaxIndex');
	$router->get('sort', 'CashController@sort');
	$router->get('/{id}/mark/{status}', 'CashController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.cash_status.applying').'|'.
		   				config('admin.global.cash_status.active')
		  	]);
});

$router->resource('cash', 'CashController');