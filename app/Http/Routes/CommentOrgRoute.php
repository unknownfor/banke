<?php
/**
 * 机构评论路由
 */
$router->group(['prefix' => 'commentorg'], function($router){
	$router->get('ajaxIndex', 'CommentOrgController@ajaxIndex');
	$router->get('sort', 'CommentOrgController@sort');
	$router->get('/{id}/mark/{status}', 'CommentOrgController@mark')
		->where([
			'id' => '[0-9]+',
			'status' => config('admin.global.status.trash').'|'.
				config('admin.global.status.audit').'|'.
				config('admin.global.status.active')
		]);
});

$router->resource('commentorg', 'CommentOrgController');