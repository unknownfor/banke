<?php
return[
	'permission' => [
		'create' 	=> 'admin.permissions.create',
		'edit' 		=> 'admin.permissions.edit',
		'destroy' 	=> 'admin.permissions.delete',
		'trash' 	=> 'admin.permissions.trash',
		'undo' 		=> 'admin.permissions.undo',
		'list' 		=> 'admin.permissions.list',
		'audit'		=> 'admin.permissions.audit'
	],
	'role' => [
		'create' 	=> 'admin.roles.create',
		'edit' 		=> 'admin.roles.edit',
		'destroy' 	=> 'admin.roles.delete',
		'trash' 	=> 'admin.roles.trash',
		'undo' 		=> 'admin.roles.undo',
		'list' 		=> 'admin.roles.list',
		'audit'		=> 'admin.roles.audit',
		'show'		=> 'admin.roles.show',
	],
	'user' => [
		'create' 	=> 'admin.users.create',
		'edit' 		=> 'admin.users.edit',
		'destroy' 	=> 'admin.users.delete',
		'trash' 	=> 'admin.users.trash',
		'undo' 		=> 'admin.users.undo',
		'list' 		=> 'admin.users.list',
		'audit'		=> 'admin.users.audit',
		'show'		=> 'admin.users.show',
		'reset'		=> 'admin.users.reset',
	],
	'menu' => [
		'create' 	=> 'admin.menus.create',
		'edit' 		=> 'admin.menus.edit',
		'destroy' 	=> 'admin.menus.delete',
	],
	'actionlog'=> [
		'show' 	=> 'admin.actionlog.show',

	],
	'article' =>[
		'create' 	=> 'admin.article.create',
		'edit' 		=> 'admin.article.edit',
		'destroy' 	=> 'admin.article.delete',
		'trash' 	=> 'admin.article.trash',
		'undo' 		=> 'admin.article.undo',
		'audit'		=> 'admin.article.audit',
		'show'		=> 'admin.article.list',
	],
	'articleCategory' =>[
		'create' 	=> 'admin.articleCategory.create',
		'edit' 		=> 'admin.articleCategory.edit',
		'destroy' 	=> 'admin.articleCategory.delete',
		'trash' 	=> 'admin.article.trash',
		'undo' 		=> 'admin.article.undo',
		'audit'		=> 'admin.article.audit',
		'show'		=> 'admin.article.list',
	],
	'dict' => [
		'create' 	=> 'admin.dict.create',
		'edit' 		=> 'admin.dict.edit',
		'destroy' 	=> 'admin.dict.delete',
		/*'trash' 	=> 'admin.dict.trash',
		'undo' 		=> 'admin.dict.undo',*/
	],
	'org' => [
		'create' 	=> 'admin.org.create',
		'edit' 		=> 'admin.org.edit',
		'destroy' 	=> 'admin.org.delete',
		'show' 	=> 'admin.org.show',
		/*'trash' 	=> 'admin.dict.trash',
		'undo' 		=> 'admin.dict.undo',*/
	],
	'course' => [
		'create' 	=> 'admin.course.create',
		'edit' 		=> 'admin.course.edit',
		'destroy' 	=> 'admin.course.delete',
		'show' 	=> 'admin.course.show',
	],
	'app_user' =>[
		'edit' 		=> 'admin.app_user.edit',
		'destroy' 	=> 'admin.app_user.delete',
		'trash' 	=> 'admin.app_user.trash',
		'undo' 		=> 'admin.app_user.undo',
		'audit'	=> 'admin.app_user.audit',
		'show'		=> 'admin.app_user.list',
		'certificate'	=> 'admin.app_user.certificate',
		'create_org_account' => 'admin.app_user.create_org_account'
	],
	'news' => [
		'create' 	=> 'admin.news.create',
		'edit' 		=> 'admin.news.edit',
		'destroy' 	=> 'admin.news.delete',
		'trash' 	=> 'admin.news.trash',
		'undo' 		=> 'admin.news.undo',
	],
	'enrol' => [
		'edit' 		=> 'admin.enrol.edit',
		'destroy' 	=> 'admin.enrol.delete',
		'trash' 	=> 'admin.enrol.trash',
		'undo' 		=> 'admin.enrol.undo',
	],
	'cash' => [
		'destroy' 	=> 'admin.cash.delete',
		'trash' 	=> 'admin.cash.trash',
		'undo' 		=> 'admin.cash.undo',
	],

//	报名
	'order' => [
		'create' 	=> 'admin.order.create',
		'edit' 		=> 'admin.order.edit',
//		'destroy' 	=> 'admin.order.delete',
		'show' 	=> 'admin.order.show',
		/*'trash' 	=> 'admin.dict.trash',
		'undo' 		=> 'admin.dict.undo',*/
	],
	//提现
	'cash' => [
		'edit' 		=> 'admin.cash.edit',
		'destroy' 	=> 'admin.cash.delete',
	],

	//反馈
	'feedback' => [
		'show' 		=> 'admin.feedback.show',
		'destroy' 	=> 'admin.feedback.delete',
	],
];