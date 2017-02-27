<?php
/**
 * 机构申请路由
 */
$router->group(['prefix' => 'orgapplyfor'], function($router){
	$router->get('ajaxIndex', 'OrgApplyForController@ajaxIndex');
	$router->get('sort', 'OrgApplyForController@sort');
	$router->get('/{id}/mark/{status}', 'OrgApplyForController@mark')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.status.trash').'|'.
				config('admin.global.status.audit').'|'.
				config('admin.global.status.active')
		]);
});

$router->resource('orgapplyfor', 'OrgApplyForController');