<?php
/**
 * 邀请路由
 */
$router->group(['prefix' => 'faq'], function($router){
	$router->get('ajaxIndex', 'FaqController@ajaxIndex');
	$router->get('sort', 'FaqController@sort');
	$router->get('/{id}/mark/{status}', 'FaqController@mark')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.status.trash').'|'.
				config('admin.global.status.audit').'|'.
				config('admin.global.status.active')
		]);
});

$router->resource('faq', 'FaqController');