<?php
/**
 * 邀请路由
 */
$router->group(['prefix' => 'orgrebates'], function($router){
	$router->get('ajaxIndex', 'OrgRebatesController@ajaxIndex');
	$router->get('sort', 'OrgRebatesController@sort');
	$router->get('/{id}/mark/{status}', 'OrgRebatesController@mark')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.status.trash').'|'.
				config('admin.global.status.audit').'|'.
				config('admin.global.status.active')
		]);
});

$router->resource('orgrebates', 'OrgRebatesController');