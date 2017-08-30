<?php
/**
 * 后台全局配置
 */
return[
	/**
	 * 全局状态
	 * audit 	待审核
	 * active 	正常
	 * ban 		拒绝
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

	'test'=>'123',

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
		'ban' => 2,
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
		['key'=>'WITHDRAW','desc' => '提现'],
		['key'=>'CHECK_IN_SUCCESS','desc' => '打卡奖励'],
		['key'=>'INVITE_FRIEND_ENROL_SUCCESS','desc' => '邀请报名成功奖励'],
		['key'=>'INVITE_FRIEND_REGISTER_AND_CERTIFICATE_SUCCESS','desc' => '邀请认证成功奖励'],
		['key'=>'REGISTER_AND_CERTIFICATE_SUCCESS','desc' => ' 注册并认证奖励'],
		['key'=>'REGISTER_SUCCESS','desc' => '注册奖励'],
		['key'=>'PUNISHMENT','desc' => '惩罚'],
		['key'=>'REFUND','desc' => '退款'],
		['key'=>'WITHDRAW_FAIL','desc' => '提现失败退回'],
		['key'=>'COMMENT','desc' => '评论奖励'], //v1.5之后区分 COMMENT_ORG COMMENT_COURSE
		['key'=>'COMMENT_ORG','desc' => '机构评论奖励'],
		['key'=>'COMMENT_COURSE','desc' => '课程心得奖励'],
		['key'=>'SHARE_GROUP_BUYING','desc' => '开团分享'],
		['key'=>'SHARE_SUCCESS','desc' => '分享奖励'],
		['key'=>'INVITE_FRIEND_BECOME_MARKETING_AMBASSADOR','desc' => '邀请好友成为推广大使奖励'],
		['key'=>'COMMENT_APP_STORE','desc' => '应用市场好评奖励'],
		['key'=>'SIGN_SUCCESS','desc' => '新打卡'],

	],

	'moneynews_business_type' => [
		'CHECK_IN_SUCCESS' => '打卡',
		'ENROL_SUCCESS' => '报名',
		'INVITE_FRIEND_ENROL_SUCCESS' => '邀请好友报名',
		'INVITE_STUDENT_ENROL_SUCCESS'=>'邀请学生报名',
		'SHARE_GROUP_BUYING' => '开团分享',
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
		'show' => false,
		// trait 中的 action 参数
		'action' => 'org',
	],
	//机构总表
	'orgsummary' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'orgsummary',
	],
	//课程
	'course' => [
		// 控制是否显示查看按钮
		'show' => false,
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
		'active' => 1,  //通过 正常
		'audit' => 0,//待审
		'ban' => 2,  //退款
		'trash' => 99, //不通过
	],

	//报名订金
	'orderdeposit' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'orderdeposit',
		'active' => 1,  //通过 正常
		'audit' => 0,//待审
		'ban' => 2,  //退款
		'trash' => 99, //不通过
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

	//机构返款
	'orgrebates' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'orgrebates',
	],

	//学生退款
	'drawback' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'drawback',
		'active' => 1,
		'audit' => 0,
		'trash' => 99,
	],

	//学生退款
	'banner' => [
		// 控制是否显示查看按钮
		'show' => true,
		// trait 中的 action 参数
		'action' => 'banner',
//		'active' => 1,
//		'audit' => 0,
//		'trash' => 99,
	],

	//教育分类
	'traincategory' => [
		// 控制是否显示查看按钮
		'show' => true,
		'action' => 'traincategory',
	],

	//机构评论
	'commentorg' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'commentorg',
	],

	//机构评论
	'commentcourse' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'commentcourse',
	],

	//开团
	'groupbuying' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'groupbuying',
	],

	//开团标语
	'groupbuyingwords' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'groupbuyingwords',
	],

	//招生老师
	'recruiteteacher' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'recruiteteacher',
	],

	//赚钱攻略
	'moneystrategy' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'moneystrategy',
	],

	//app提示
	'alertbox' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'alertbox',
	],

	//赚钱动态
	'moneynews' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'moneynews',
	],

	//活动
	'activity' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'activity',
	],

	//教学老师
	'teachingteacher' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'teachingteacher',
	],

	//推广大使
	'marketingambassador' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'marketingambassador',
	],

	//app 好评
	'commentappstore' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'commentappstore',
	],

	//半课好文章
	'goodarticle' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'goodarticle',
	],

	//半课免费学
	'freestudy' => [
		// 控制是否显示查看按钮
		'show' => false,
		'action' => 'freestudy',
	],

];