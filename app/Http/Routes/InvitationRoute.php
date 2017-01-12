<?php
/**
 * 提现路由
 */
$router->group(['prefix' => 'invitation'], function($router){
	$router->get('ajaxIndex', 'InvitationController@ajaxIndex');
	$router->get('sort', 'InvitationController@sort');
	$router->get('/{id}/mark/{status}', 'InvitationController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('invitation', 'InvitationController');