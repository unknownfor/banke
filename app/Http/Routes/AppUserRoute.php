<?php
/**
 * 用户路由
 */
$router->group(['prefix' => 'app_user'], function($router){
	$router->get('ajaxIndex', 'AppUserController@ajaxIndex');
	$router->get('/{id}/mark/{status}', 'AppUserController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
	//认证申请
	$router->get('certification','AppUserController@certification');
	$router->get('ajaxCertification', 'AppUserController@ajaxCertification');
	$router->get('/{id}/certificate/{status}', 'AppUserController@certificate')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.certification_status.trash').'|'.
				config('admin.global.certification_status.audit').'|'.
				config('admin.global.certification_status.active')
		]);

	//返现管理
	$router->get('cash_back','AppUserController@cash_back');
	$router->get('ajaxCashBack', 'AppUserController@ajaxCashBack');
	$router->get('/{id}/mark_cash_back/{status}', 'AppUserController@mark_cash_back')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.status.trash').'|'.
				config('admin.global.status.audit').'|'.
				config('admin.global.status.active')
		]);

	//机构用户
	$router->get('org_account', 'AppUserController@org_account');
	$router->get('ajaxOrgAccount', 'AppUserController@ajaxOrgAccount');
	$router->get('/{id}/mark/{status}', 'AppUserController@mark_org_account')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.status.trash').'|'.
				config('admin.global.status.audit').'|'.
				config('admin.global.status.active')
		]);
	$router->get('create_org_account', 'AppUserController@create_org_account');
	$router->post('store_org_account_old', 'AppUserController@store_org_account_old');
	$router->post('store_org_account_new', 'AppUserController@store_org_account_new');
});

$router->resource('app_user', 'AppUserController');