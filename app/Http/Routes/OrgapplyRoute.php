<?php
/**
 * 申请机构路由
 */
$router->group(['prefix' => 'orgapply'], function($router){
	$router->get('ajaxIndex', 'OrgApplyController@ajaxIndex');
	$router->get('sort', 'OrgApplyController@sort');
	$router->get('/{id}/mark/{status}', 'OrgApplyController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('orgapply', 'OrgApplyController');