<?php
/**
 * 机构路由
 */
$router->group(['prefix' => 'orgsummary'], function($router){
	$router->get('ajaxIndex', 'OrgSummaryController@ajaxIndex');
	$router->get('sort', 'OrgSummaryController@sort');
//	$router->get('branchlist/{id}', 'OrgSummaryController@branchlist');
	$router->get('/{id}/branchlist', 'OrgSummaryController@branchlist');
	$router->get('/{id}/mark/{status}', 'OrgSummaryController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('orgsummary', 'OrgSummaryController');