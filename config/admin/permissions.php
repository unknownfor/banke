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
	'orgsummary' => [
		'create' 	=> 'admin.orgsummary.create',
		'edit' 		=> 'admin.orgsummary.edit',
		'destroy' 	=> 'admin.orgsummary.delete',
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

	//报名
	'order' => [
		'create' 	=> 'admin.order.create',
		'edit' 		=> 'admin.order.edit',
//		'destroy' 	=> 'admin.order.delete',
		'show' 	=> 'admin.order.show',
		/*'trash' 	=> 'admin.dict.trash',
		'undo' 		=> 'admin.dict.undo',*/
	],

	//订金
	'orderdeposit' => [
		'edit' 		=> 'admin.orderdeposit.edit',
		'destroy' 	=> 'admin.orderdeposit.delete',
	],

	//提现
	'withdraw' => [
		'show' 		=> 'admin.withdraw.show',
		'edit'	=> 'admin.withdraw.edit',
		'financialedit'	=> 'admin.withdraw.financialedit',
	],

	//反馈
	'feedback' => [
		'show' 		=> 'admin.feedback.show',
		'edit' 		=> 'admin.feedback.edit',
		'destroy' 	=> 'admin.feedback.delete',
	],

	//常见问题
	'faq' => [
		'show' 		=> 'admin.faq.show',
		'create' 	=> 'admin.faq.create',
		'edit' 		=> 'admin.faq.edit',
		'destroy' 	=> 'admin.faq.delete',
	],
	//签到
	'checkin' => [
		'show' 		=> 'admin.checkin.show',
		'edit' 		=> 'admin.checkin.edit',
	],

	//app升级
	'appUpdate' => [
		'show' 		=> 'admin.appUpdate.show',
		'create' 	=> 'admin.appUpdate.create',
		'edit' 		=> 'admin.appUpdate.edit',
		'destroy' 	=> 'admin.appUpdate.delete',
	],
	//媒体报道
	'report' => [
		'show' 		=> 'admin.report.show',
		'create' 	=> 'admin.report.create',
		'edit' 		=> 'admin.report.edit',
		'destroy' 	=> 'admin.report.delete',
	],
	//机构入驻申请
	'orgapplyfor' => [
		'show' 	=> 'admin.orgapplyfor.show',
//		'edit' 	=> 'admin.orgapplyfor.edit',
		'destroy' 	=> 'admin.orgrebates.delete',
	],
	//机构返款
	'orgrebates' => [
		'show' 		=> 'admin.orgrebates.show',
		'create' 	=> 'admin.orgrebates.create',
		'edit' 		=> 'admin.orgrebates.edit',
		'destroy' 	=> 'admin.orgrebates.delete',
	],

	//学生退款
	'drawback' => [
		'show' 		=> 'admin.drawback.show',
		'create' 	=> 'admin.drawback.create',
		'edit' 		=> 'admin.drawback.edit',
		'destroy' 	=> 'admin.drawback.delete',
	],

	//banner
	'banner' => [
		'show' 		=> 'admin.banner.show',
		'create' 	=> 'admin.banner.create',
		'edit' 		=> 'admin.banner.edit',
		'destroy' 	=> 'admin.banner.delete',
	],

	'traincategory' => [
		'show' 		=> 'admin.traincategory.show',
		'create' 	=> 'admin.traincategory.create',
		'edit' 		=> 'admin.traincategory.edit',
		'destroy' 	=> 'admin.traincategory.delete',
	],

	'commentorg' => [
		'show' 		=> 'admin.commentorg.show',
		'create' 	=> 'admin.commentorg.create',
		'edit' 		=> 'admin.commentorg.edit',
		'destroy' 	=> 'admin.commentorg.delete',
	],

	'commentcourse' => [
		'show' 		=> 'admin.commentcourse.show',
		'create' 	=> 'admin.commentcourse.create',
		'edit' 		=> 'admin.commentcourse.edit',
		'destroy' 	=> 'admin.commentcourse.delete',
	],

	'groupbuying' => [
		'show' 		=> 'admin.groupbuying.show',
		'destroy' 	=> 'admin.groupbuying.delete',
	],

	'groupbuyingwords' => [
		'create' 	=> 'admin.groupbuyingwords.create',
		'edit' 		=> 'admin.groupbuyingwords.edit',
		'destroy' 	=> 'admin.groupbuyingwords.delete',
	],

	'recruiteteacher' => [
		'edit' 		=> 'admin.recruiteteacher.edit',
		'destroy' 	=> 'admin.recruiteteacher.delete',
	],

	'moneystrategy' => [
		'create' 	=> 'admin.moneystrategy.create',
		'edit' 		=> 'admin.moneystrategy.edit',
		'destroy' 	=> 'admin.moneystrategy.delete',
	],

	'alertbox' => [
		'create' 	=> 'admin.alertbox.create',
		'edit' 		=> 'admin.alertbox.edit',
		'destroy' 	=> 'admin.alertbox.delete',
	],

	'moneynews' => [
		'create' 	=> 'admin.moneynews.create',
		'edit' 		=> 'admin.moneynews.edit',
		'destroy' 	=> 'admin.moneynews.delete',
	],

	'activity' => [
		'create' 	=> 'admin.activity.create',
		'edit' 		=> 'admin.activity.edit',
		'destroy' 	=> 'admin.activity.delete',
	],

	'teachingteacher' => [
		'create' 	=> 'admin.teachingteacher.create',
		'edit' 		=> 'admin.teachingteacher.edit',
		'destroy' 	=> 'admin.teachingteacher.delete',
	],

	'marketingambassador' => [
		'certificate' 	=> 'admin.marketingambassador.certificate',
		'destroy' 	=> 'admin.marketingambassador.delete',
	],

	'commentappstore' => [
		'certificate' 	=> 'admin.commentappstore.certificate',
		'destroy' 	=> 'admin.commentappstore.delete',
	],

	'goodarticle' => [
		'create' 	=> 'admin.goodarticle.create',
		'destroy' 	=> 'admin.goodarticle.delete',
	],

	'freestudy' => [
		'create' 	=> 'admin.freestudy.create',
		'edit' 	=> 'admin.freestudy.edit',
		'destroy' 	=> 'admin.freestudy.delete',
	],

	'freestudyusers' => [

	],

	'task'=>[
		'create' 	=> 'admin.task.create',
		'edit' 	=> 'admin.task.edit',
		'destroy' 	=> 'admin.task.delete',
	],

	'taskform'=>[
		'create' 	=> 'admin.taskform.create',
		'edit' 	=> 'admin.taskform.edit',
		'destroy' 	=> 'admin.taskform.delete',
	],

	'taskformdetail'=>[
		'create' 	=> 'admin.taskformdetail.create',
		'edit' 	=> 'admin.taskformdetail.edit',
		'destroy' 	=> 'admin.taskformdetail.delete',
	],

];