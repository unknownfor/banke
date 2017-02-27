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

	/*认证状态  此处弄反，和其他的不一样
	* audit 	正常
	* active 	待审核
	* no_apply  未申请
	* trash		回收站
	 */
	'certification_status' => [
		'audit' => 2,
		'active' => 1,
		'no_apply' => 0,
		'trash' => 3,
	],

	//提现状态
	'withdraw_status' => [
		'audit' => 0,
		'active' => 1,
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
	'balance_log' => [
		'WITHDRAW' => '提现',
		'CHECK_IN_SUCCESS' => '打卡奖励',
		'INVITE_FRIEND_ENROL_SUCCESS' => '邀请报名成功奖励',
		'REGISTER_AND_CERTIFICATE_SUCCESS' => ' 注册奖励',
		'USER_CERTIFICATE_SUCCESS' => '邀请注册奖励',
		'PUNISHMENT' => '惩罚',
		'REFUND' => '退款',
		'WITHDRAW_FAIL' => '提现失败退回'
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
	'withdraw' => [
		// 控制是否显示查看按钮
		'show' => false,
		// trait 中的 action 参数
		'action' => 'withdraw',
	],

	//报名
	'order' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'order',
		'active' => 1,
		'audit' => 2,
		'trash' => 3,
	],

	//反馈
	'feedback' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'feedback',
	],

	//常见问题
	'faq' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'faq',
	],

	//签到
	'checkin' => [
		// 控制是否显示查看按钮
		'show' => false,
		// trait 中的 action 参数
		'action' => 'checkin',
	],

	//app升级
	'appUpdate' => [
		// 控制是否显示查看按钮
		'show' => false,
		// trait 中的 action 参数
		'action' => 'appUpdate',
	],
	//媒体报道
	'report' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'report',
	],

	//机构申请
	'orgapplyfor' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'orgapplyfor',
	],
];