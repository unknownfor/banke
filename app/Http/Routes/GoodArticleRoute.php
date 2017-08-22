<?php
/**
 * 半课好文路由
 */
$router->group(['prefix' => 'goodarticle'], function($router){
	$router->get('ajaxIndex', 'GoodArticleController@ajaxIndex');
	$router->get('sort', 'GoodArticleController@sort');
	$router->get('/{id}/mark/{status}', 'GoodArticleController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('goodarticle', 'GoodArticleController');