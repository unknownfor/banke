<?php
/**
 * 邀请路由
 */
$router->group(['prefix' => 'drawback'], function($router){
	$router->get('ajaxIndex', 'DrawbackController@ajaxIndex');
	$router->get('sort', 'DrawbackController@sort');
	$router->get('/{id}/mark/{status}', 'DrawbackController@mark')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.status.trash').'|'.
				config('admin.global.status.audit').'|'.
				config('admin.global.status.active')
		]);
});

$router->resource('drawback', 'DrawbackController');