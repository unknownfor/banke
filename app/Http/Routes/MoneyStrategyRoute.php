<?php
/**
 * 赚钱攻略路由
 */
$router->group(['prefix' => 'moneystrategy'], function($router){
	$router->get('ajaxIndex', 'MoneyStrategyController@ajaxIndex');
	$router->get('/{id}/mark/{status}', 'MoneyStrategyController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('moneystrategy', 'MoneyStrategyController');