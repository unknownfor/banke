<?php
return [
	'user' => [
		'status' => [
			'audit' => ['fa fa-paw','待审核'],
			'active' => ['fa fa-navicon','正常'],
			'trash' => ['fa fa-trash','回收站']
		]
	],
	'permission' => [
		'audit' => ['fa fa-paw','待审核'],
		'active' => ['fa fa-navicon','正常'],
		'trash' => ['fa fa-trash','回收站'],
	],
	'role' => [
		'audit' => ['fa fa-paw','待审核'],
		'active' => ['fa fa-navicon','正常'],
		'trash' => ['fa fa-trash','回收站'],
	],
	'user' => [
		'audit' => ['fa fa-paw','待审核'],
		'active' => ['fa fa-navicon','正常'],
		'trash' => ['fa fa-trash','回收站'],
	],
	'dict' => [
		'active' => ['fa fa-navicon','正常'],
		'trash' => ['fa fa-trash','回收站'],
	],

	/*认证状态  此处弄反，和其他的不一样
	* audit 	正常 2
	* active 	待审核1
	* no_apply  未申请0
	* trash		回收站3
	 */

	'app_user' => [
		'active' => ['fa fa-navicon','待审核'],
		'audit' => ['fa fa-paw','已认证'],
		'trash' => ['fa fa-trash','未通过'],
		'no_apply' => ['fa fa-paw','未申请'],
	],
	'org' => [
		'audit' => ['fa fa-paw','待审核'],
		'active' => ['fa fa-navicon','正常'],
		'trash' => ['fa fa-trash','未通过']
	],
	'orgsummary' => [
		'audit' => ['fa fa-paw','待审核'],
		'active' => ['fa fa-navicon','正常'],
		'trash' => ['fa fa-trash','未通过']
	],
	'orgsurperior' => [
		'active' => ['fa fa-paw','是'],
		'audit' => ['fa fa-navicon','否']
	],
	'course' => [
		'audit' => ['fa fa-paw','待审核'],
		'active' => ['fa fa-navicon','正常'],
		'trash' => ['fa fa-trash','未通过']
	],
	'news' => [
		'audit' => ['fa fa-paw','待审核'],
		'active' => ['fa fa-navicon','正常'],
		'trash' => ['fa fa-trash','未通过']
	],
	'enrol' => [
		'audit' => ['fa fa-paw','未处理'],
		'active' => ['fa fa-navicon','已处理'],
	],
	'withdraw' => [
		'audit' => ['fa fa-paw','申请中'],
		'active' => ['fa fa-navicon','已打款'],
		'ban' => ['fa fa-trash','未通过']
	],
	'checkin' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
		'ban' => ['fa fa-trash','惩罚']
	],
	'order' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
		'ban' => ['fa fa-trash','已退款']
	],

	'faq' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
	],

	'faqtype' => [
		'audit' => ['fa fa-paw','普通问题'],
		'active' => ['fa fa-navicon','咨询问题'],
	],

	'appUpdate' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
	],
	'feedback' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','已审核'],
	],
	'report' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
	],
	'orgapplyfor' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
	],
	'orgrebates' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
	],
	'drawback' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
	],

	'banner' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
	],

	'traincategory' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
	],

	'comment_status'=> [
		'audit' => ['fa fa-paw','未打赏'],
		'active' => ['fa fa-navicon','已打赏']
	],
	'read_status'=> [
		'audit' => ['fa fa-paw','未读'],
		'active' => ['fa fa-navicon','已读']
	],

	'commentorg' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
	],

	'commentcourse' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
	],

	'groupbuyingwords' => [
		'audit' => ['fa fa-paw','未审核'],
		'active' => ['fa fa-navicon','审核通过'],
		'trash' => ['fa fa-trash','未通过'],
	],
];