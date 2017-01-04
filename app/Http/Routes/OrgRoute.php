<?php
/**
 * 机构路由
 */
$router->group(['prefix' => 'org'], function($router){
	$router->get('ajaxIndex', 'OrgController@ajaxIndex');
	$router->get('sort', 'OrgController@sort');
	$router->get('/{id}/mark/{status}', 'OrgController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('org', 'OrgController');