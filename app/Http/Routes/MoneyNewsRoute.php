<?php
/**
 * 赚钱动态路由
 */
$router->group(['prefix' => 'moneynews'], function($router){
	$router->get('ajaxIndex', 'MoneyNewsController@ajaxIndex');
	$router->get('/{id}/mark/{status}', 'MoneyNewsController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('moneynews', 'MoneyNewsController');