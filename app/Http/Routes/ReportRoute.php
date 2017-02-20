<?php
/**
 * 媒体报道路由
 */
$router->group(['prefix' => 'report'], function($router){
	$router->get('ajaxIndex', 'ReportController@ajaxIndex');
	$router->get('sort', 'ReportController@sort');
	$router->get('/{id}/mark/{status}', 'ReportController@mark')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.status.trash').'|'.
				config('admin.global.status.audit').'|'.
				config('admin.global.status.active')
		]);
});

$router->resource('report', 'ReportController');