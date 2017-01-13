<?php
/**
 * 后台全局配置
 */
return[
	/**
	 * 全局状态
	 * audit 	待审核
	 * active 	正常
	 * ban 		禁用
	 * trash	回收站
	 * destory 	彻底删除
	 */
	'status' => [
		'audit' => 0,
		'active' => 1,
		'ban' => 2,
		'trash' => 99,
		'destroy' => -1
	],
	//认证状态
	'certification_status' => [
		'no_apply' => 0,
		'audit' => 1,
		'active' => 2,
		'trash' => 3,
	],
	//分页
	'list' => [
		'start' => 0,
		'length' => 100
	],
	//权限
	'permission' => [
		// 控制是否显示查看按钮
		'show' => false,
		// trait 中的 action 参数
		'action' => 'permission',
	],
	//角色
	'role' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'role',
	],
	//用户
	'user' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'user',
	],
	//操作日志
	'actionlog' => [
	// 控制是否显示查看按钮
	'show' => true,
	// trait 中的 action 参数
	'action' => 'actionlog',
	],
	//文章
	'article' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'article',
],
	//文章
	'articleCategory' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'articleCategory',
	],
	//用户
	'dict' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'dict',
	],
	//机构
	'org' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'org',
	],
	//课程
	'course' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'course',
	],

	//app用户
	'app_user' => [
		// 控制是否显示查看按钮
		'show' => false,
		// trait 中的 action 参数
		'action' => 'app_user',
	],

	//动态
	'news' => [
		// 控制是否显示查看按钮
		'show' => false,
		// trait 中的 action 参数
		'action' => 'news',
	],
	//预约报名
	'enrol' => [
		// 控制是否显示查看按钮
		'show' => false,
		// trait 中的 action 参数
		'action' => 'enrol',
	],

	//提现
	'cash' => [
		// 控制是否显示查看按钮
		'show' => false,
		// trait 中的 action 参数
		'action' => 'cash',
	],

	//报名   order  和 modal 的名字 要一致
	'order' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'order',
	],
];