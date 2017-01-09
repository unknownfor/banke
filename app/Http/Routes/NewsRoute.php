<?php
/**
 * 角色路由
 */
$router->group(['prefix' => 'news'], function($router){
	$router->get('ajaxIndex', 'NewsController@ajaxIndex');
	$router->get('/{id}/mark/{status}', 'NewsController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('news', 'NewsController');