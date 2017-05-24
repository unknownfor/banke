<?php
/**
 * 开团标语路由
 */
$router->group(['prefix' => 'groupbuyingwords'], function($router){
	$router->get('ajaxIndex', 'GroupbuyingWordsController@ajaxIndex');
	$router->get('sort', 'GroupbuyingWordsController@sort');

	$router->get('/{id}/mark/{status}', 'GroupbuyingWordsController@mark')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.status.trash').'|'.
				config('admin.global.status.audit').'|'.
				config('admin.global.status.active')
		]);
});

$router->resource('groupbuyingwords', 'GroupbuyingWordsController');