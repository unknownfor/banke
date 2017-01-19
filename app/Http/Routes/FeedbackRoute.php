<?php
/**
 * 机构路由
 */
$router->group(['prefix' => 'feedback'], function($router){
	$router->get('ajaxIndex', 'FeedbackController@ajaxIndex');
	$router->get('sort', 'FeedbackController@sort');
	$router->get('/{id}/mark/{status}', 'FeedbackController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('feedback', 'FeedbackController');