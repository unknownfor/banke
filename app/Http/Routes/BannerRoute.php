<?php
/**
 * banner路由
 */
$router->group(['prefix' => 'banner'], function($router){
	$router->get('ajaxIndex', 'BannerController@ajaxIndex');
	$router->get('/{id}/mark/{status}', 'BannerController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('banner', 'BannerController');