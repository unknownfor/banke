<?php
/**
 * 应用商店评论路由
 */
$router->group(['prefix' => 'commentappstore'], function($router){
	$router->get('ajaxIndex', 'CommentAppStoreController@ajaxIndex');
	$router->get('sort', 'CommentAppStoreController@sort');
	$router->get('/{id}/mark/{status}', 'CommentAppStoreController@mark')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.status.trash').'|'.
				config('admin.global.status.audit').'|'.
				config('admin.global.status.active')
		]);
	$router->get('/{id}/certificate/{status}', 'CommentAppStoreController@certificate')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.certification_status.trash').'|'.
				config('admin.global.certification_status.audit').'|'.
				config('admin.global.certification_status.active')
		]);
});

$router->resource('commentappstore', 'CommentAppStoreController');