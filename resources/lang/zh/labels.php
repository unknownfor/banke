<?php
return [
	'action' => '操作',
	'id' => 'ID',
	'close' => '关闭',
	'menuLevel' => '顶级菜单',
	'logout' => '退出',
	'profile' => '我的资料',
	'lock'  => '锁屏',
	'created_at' => '创建时间',
	'updated_at' => '修改时间',
	'view' => '查看',
	'search'=>' 搜索',
	'user' => [
		'id' => '序号',
		'name' => '用户名',
		'email' => '邮箱',
		'password' => '密码',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'remember_token' => 'token',
		'list' => '用户列表',
		'confirm_email' => '邮箱验证',
		'show' => '查看用户信息',
		'reset' => '修改密码',
		'permission' => '额外权限',
		'confirm' => '已验证',
		'active' => '<span class="label label-success"> 已验证 </span>',
		'audit' => '<span class="label label-warning"> 未验证 </span>',
		'notice' => '<strong>注意!</strong> 当某个角色的用户需要额外权限时添加.',
		'info' => '暂无额外权限',
	],
	'permission' => [
		'id' => '序号',
		'name' => '权限名称',
		'slug' => '权限',
		'description' => '描述',
		'model' => '模型',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '权限列表'
	],
	'role' => [
		'id' => '序号',
		'name' => '角色名称',
		'slug' => '角色',
		'description' => '描述',
		'level' => '等级',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '角色列表',
		'permission' => '权限',
		'module' => '模块',
		'show' => '查看角色权限',
	],
	'menu' => [
		'id' => 'ID',
		'name' => '名称',
		'pid' => '一级菜单',
		'language' => '语言',
		'icon' => '图标',
		'slug' => '权限',
		'url' => '地址',
		'description' => '描述',
		'sort' => '排序',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'detail' => '<i class="fa fa-cog"></i> 菜单属性',
		'show' => '查看',
	],
	'action_log' => [
		'list' => '行为日志列表',
		'username' => '用户名',
		'type' => '类型',
		'ip' => 'ip地址',
		'browser' => '浏览器',
		'system' => '操作系统',
		'url' => '操作地址',
	],
	'article' =>[
		'list' => '文章列表',
		'title' => '标题',
		'desc' => '描述',
		'author' => '作者',
		'from' => '来源',
		'content' => '文章内容',
		'thumb' => '封面',
		'status' => '状态',
	],
	'article_category' =>[
		'list' => '文章分类列表',
		'name' => '分类名称',
		'pid' => '上级分类',
		'status' => '文章分类状态',
	],
	'breadcrumb' => [
		'home' => '<i class="fa fa-home"></i> 主页',
		'permissionList' => '<i class="fa fa-bars"></i> 权限列表',
		'permissionCreate' => '<i class="fa fa-paper-plane-o"></i> 创建权限',
		'permissionEdit' => '<i class="fa fa-pencil"></i> 修改权限',
		'roleList' => '<i class="fa fa-bars"></i> 角色列表',
		'roleCreate' => '<i class="fa fa-user-plus"></i> 创建角色',
		'roleEdit' => '<i class="fa fa-pencil"></i> 修改角色',
		'userList' => '<i class="fa fa-bars"></i> 用户列表',
		'userCreate' => '<i class="fa fa-user-plus"></i> 创建用户',
		'userEdit' => '<i class="fa fa-pencil"></i> 修改用户',
		'userReset' => '<i class="fa fa-lock"></i> 修改密码',
		'userShow' => '<i class="fa fa-user"></i> 用户信息',
		'menuList' => '<i class="fa fa-cogs"></i> 菜单管理',
		'logList' => '<i class="fa fa-cogs"></i> 系统日志',
		'logs' => '<i class="fa fa-navicon"></i> 日志列表',
		'logDetail' => '<i class="fa fa-television"></i> 日志详情',
		'imageUpload' => '<i class="fa fa-cloud-upload"></i> 图片上传',
		'imageUploadTips' => ' 请选择 png/jpg 图片',
		'imageSelect' => '<i class="fa fa-photo"></i> 图片选择器',
		'imageList' => '<i class="fa fa-photo"></i> 图片列表',
		'action_log' => '<i class="fa fa-bell"></i> 操作日志',
		'functionSwitch' => '<i class="fa fa-power-off"></i> 功能开关',
		'emailTemple' => '<i class="fa fa-envelope-o"></i> 邮件模板',
		'changeProfile' =>'<i class="fa fa-cog"></i> 修改资料',
		'articleList' => '<i class="fa fa-cog"></i> 文章列表',
		'articleCreate' => '<i class="fa fa-cog"></i> 文章添加',
		'articleEdit' => '<i class="fa fa-cog"></i> 文章编辑',
		'articleCategoryList' => '<i class="fa fa-cog"></i> 文章分类列表',
		'articleCategoryCreate' => '<i class="fa fa-cog"></i> 文章分类添加',
		'orgList' => '<i class="fa fa-th-list"></i> 机构列表',
		'orgCreate' => '<i class="fa fa-user-plus"></i> 创建机构',
		'orgEdit' => '<i class="fa fa-pencil"></i> 修改机构',
		'orgShow' => '<i class="fa fa-building"></i> 机构信息',
		'courseList' => '<i class="fa fa-bars"></i> 课程列表',
		'courseCreate' => '<i class="fa fa-user-plus"></i> 创建课程',
		'courseEdit' => '<i class="fa fa-pencil"></i> 修改课程',
		'courseShow' => '<i class="fa fa-book"></i> 课程信息',
		'dictList' => '<i class="fa fa-bars"></i> 配置列表',
		'dictCreate' => '<i class="fa fa-user-plus"></i> 创建配置',
		'dictEdit' => '<i class="fa fa-user-plus"></i> 编辑配置',
		'app_userList' => '<i class="fa fa-bars"></i> app用户列表',
		'certificationList' => '<i class="fa fa-bars"></i> 用户认证申请列表',
		'newsList' => '<i class="fa fa-bars"></i> 动态列表',
		'newsCreate' => '<i class="fa fa-user-plus"></i> 创建动态',
		'newsEdit' => '<i class="fa fa-user-plus"></i> 编辑动态',
		'enrolList' => '<i class="fa fa-bars"></i> 预约报名列表',
		'enrolEdit' => '<i class="fa fa-user-plus"></i> 编辑预约报名',
		'cashList' => '<i class="fa fa-th-list"></i> 提现列表',
		'checkinList' => '<i class="fa fa-th-list"></i> 签到列表',
		'checkinEdit' => '<i class="fa fa-th-list"></i> 编辑签到',
		'invitationList' => '<i class="fa fa-share-alt"></i> 邀请列表',
		'orderList' => '<i class="fa fa-share-alt"></i> 报名列表',
		'orderCreate' => '<i class="fa fa-user-plus"></i> 添加报名',
		'orderEdit' => '<i class="fa fa-user-plus"></i> 编辑报名',
		'orderShow' => '<i class="fa fa-search"></i> 报名详情',
		'invitationList' => '<i class="fa fa-th-list"></i> 邀请列表',
		'orgAccountList' => '<i class="fa fa-bars"></i> 机构账户列表',
		'orgAccountCreate' => '<i class="fa fa-bars"></i> 创建机构账户',
		'withdrawList' => '<i class="fa fa-share-alt"></i> 提现列表',
		'withdrawEdit' => '<i class="fa fa-pencil"></i> 审核提现',
		'feedbackList' => '<i class="fa fa-exchange"></i> 反馈列表',
		'feedbackShow' => '<i class="fa fa-search"></i> 反馈详情',
		'feedbackEdit' => '<i class="fa fa-pencil"></i> 编辑反馈',
		'faqList' => '<i class="fa fa-exchange"></i> 问题列表',
		'faqShow' => '<i class="fa fa-search"></i> 问题详情',
		'faqCreate'=>'<i class="fa fa-user-plus"></i> 添加问题',
		'faqShow' => '<i class="fa fa-search"></i> 问题详情',
		'faqEdit' => '<i class="fa fa-search"></i> 编辑问题',
		'appUpdateList' => '<i class="fa fa-exchange"></i> 版本列表',
		'appUpdateCreate'=>'<i class="fa fa-user-plus"></i> 添加版本',
		'appUpdateEdit' => '<i class="fa fa-search"></i> 编辑版本',
		'reportList' => '<i class="fa fa-comment"></i> 媒体报道列表',
		'reportShow' => '<i class="fa fa-search"></i> 媒体报道详情',
		'reportCreate'=>'<i class="fa fa-user-plus"></i> 添加媒体报道',
		'reportShow' => '<i class="fa fa-search"></i> 媒体报道详情',
		'reportEdit' => '<i class="fa fa-search"></i> 编辑媒体报道',

		'orgapplyforList' => '<i class="fa fa-th-list"></i> 机构入驻申请列表',
		'orgapplyforEdit' => '<i class="fa fa-user-plus"></i> 创建机构入驻申请',
		'orgapplyforShow' => '<i class="fa fa-building"></i> 机构入驻申请信息',

		'orgrebatesList' => '<i class="fa fa-exchange"></i> 返款列表',
		'orgrebatesCreate'=>'<i class="fa fa-user-plus"></i> 添加返款',
		'orgrebatesShow' => '<i class="fa fa-search"></i> 返款详情',
		'orgrebatesEdit' => '<i class="fa fa-pencil"></i> 编辑返款',

		'drawbackList' => '<i class="fa fa-exchange"></i> 退款列表',
		'drawbackShow' => '<i class="fa fa-search"></i> 退款详情',
		'drawbackCreate'=>'<i class="fa fa-user-plus"></i> 添加退款',
		'drawbackEdit' => '<i class="fa fa-pencil"></i> 编辑退款',

		'bannerList' => '<i class="fa fa-exchange"></i> 轮播图列表',
		'bannerShow' => '<i class="fa fa-search"></i> 轮播图详情',
		'bannerCreate'=>'<i class="fa fa-user-plus"></i> 添加轮播图',
		'bannerEdit' => '<i class="fa fa-pencil"></i> 编辑轮播图',

		'traincategoryList' => '<i class="fa fa-exchange"></i>分类列表',
		'traincategoryShow' => '<i class="fa fa-search"></i> 分类详情',
		'traincategoryCreate'=>'<i class="fa fa-user-plus"></i> 添加分类',
		'traincategoryEdit' => '<i class="fa fa-pencil"></i> 编辑分类',

		'commentorgList' => '<i class="fa fa-comments"></i>机构评论列表',
		'commentorgShow' => '<i class="fa fa-search"></i> 机构评论详情',
		'commentorgEdit' => '<i class="fa fa-check"></i> 审核机构评论',

		'commentcourseList' => '<i class="fa fa-comments"></i>课程评论列表',
		'commentcourseShow' => '<i class="fa fa-search"></i> 课程评论详情',
		'commentcourseEdit' => '<i class="fa fa-check"></i> 审核课程评论',


		'groupbuyingList' => '<i class="fa fa-list"></i> 开团列表',

		'groupbuyingwordsList' => '<i class="fa fa-list"></i> 开团标语列表',
		'groupbuyingwordsCreate' => '<i class="fa fa-list"></i> 添加开团标语',
		'groupbuyingwordsEdit' => '<i class="fa fa-list"></i> 编辑开团标语',
	],
	'dict' => [
		'id' => '序号',
		'key' => '配置名称',
		'value' => '配置值',
		'description' => '配置项说明',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '配置列表',
		'permission' => '权限',
		'module' => '模块',
		'show' => '查看角色权限',
	],
	'org' => [
		'id' => '序号',
		'name' => '名称',
		'short_name' => '简称',
		'logo'=>'Logo',
		'intro'=>'一句话简介',
		'city' => '城市',
		'address' => '地址',
		'cover'=>'封面',
		'album'=>'相册',
		'details'=>'详情',
		'tel_phone'=>'联系电话1',
		'tel_phone2'=>'联系电话2',
		'student_counts'=>'学习人数',
		'cash_back_desc'=>'返现描述',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'sort'=>'排序',
		'list' => '机构列表',
		'courseList' => '课程列表',
		'category' => '所属分类',
		'category1' => '一级分类',
		'category2' => '二级分类',
		'tags' => '标签',
		'share_comment_org_award'=>'评论奖励比例',
		'comment_list'=>'评论列表',
		'confirm' => '已验证',
		'active' => '<span class="label label-success"> 已验证 </span>',
		'audit' => '<span class="label label-warning"> 未验证 </span>',
		'notice' => '<strong>注意!</strong> 当某个角色的用户需要额外权限时添加.',
		'info' => '暂无额外权限',
	],
	'course' => [
		'id' => '序号',
		'name' => '名称',
		'org'=>'所属机构',
		'org_id'=>'所属机构',
		'price'=>'参考价',
		'real_price' => '成交价',
		'z_award_amount' => '介绍费',
		'cover'=>'封面',
		'details'=>'课程介绍',
		'period'=>'课时',
		'checkin_award'=>'打卡奖励比例',
		'check_in_days' => '学习天数',
		'task_award'=>'任务奖励比例',
//		'comment_award'=>'心得奖励',
		'comment_list'=>'评论列表',
		'category' => '所属分类',
		'sort'=>'排序',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'enddated_at' => '截止时间',
		'list' => '课程列表',
		'confirm' => '已验证',
		'active' => '<span class="label label-success"> 已验证 </span>',
		'audit' => '<span class="label label-warning"> 未验证 </span>',
		'notice' => '<strong>注意!</strong> 当某个角色的用户需要额外权限时添加.',
		'info' => '暂无额外权限',
		'group_buying_award'=>'开团可获最高奖励比例(%)',
		'share_group_buying_counts'=>'可分享开团次数',
		'share_group_buying_award'=>'分享开团奖励比例(%)',
		'share_comment_course_counts'=>'可分享心得次数',
		'share_comment_course_award'=>'分享心得奖励比例(%)'
	],

	'app_user' => [
		'org_account_list' => '机构账户列表',
		'list' => 'App用户列表',
		'certification' => '用户认证申请',
		'uid' => '序号',
		'name' => '昵称',
		'real_name' => '姓名',
		'mobile'=>'手机号',
		'school' => '学校',
		'major' => '专业',
		'updated_at' => '认证时间',
		'certification_picture' => '证件',
		'certification_status' => '认证状态',
		'account_balance' => '账户余额',
		'total_cashback_amount' => '返现总金额',
		'remaining_cashback_amount' => '待返现金额',
		'withdraw_amount' => '提现金额',
		'created_at' => '创建时间',
		'active' => '<span class="label label-success"> 已认证 </span>',
		'audit' => '<span class="label label-warning"> 审核中 </span>',
		'trash' => '<span class="label label-warning"> 未通过 </span>',
		'no_apply' => '<span class="label label-warning"> 未申请 </span>',
		'org_name' => '机构',
		'alldetailinfo' => '详细信息',
	],
	'news' => [
		'id' => '序号',
		'title' => '标题',
		'sort' => '排序',
		'content' => '内容',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '动态列表',
		'permission' => '权限',
		'module' => '模块',
	],
	/*预约*/
	'enrol' => [
		'id' => '序号',
		'name' => '姓名',
		'mobile' => '手机号',
		'org_id' => '机构',
		'course_id' => '课程',
		'processing_result' => '处理结果',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '预约报名列表',
		'permission' => '权限',
		'module' => '模块',
	],

	//提现
	'withdraw' => [
		'id' => '序号',
		'uid' => '学员id',
		'name' => '姓名',
		'mobile' => '手机号',
		'withdraw_amount'=>'提现金额',
		'account_balance'=>'余额',
		'zhifubao_account'=>'提现账户',
		'status' => '状态',
		'list' => '提现列表',
		'created_at' => '申请时间',
		'operator_id'=>'处理人员id',
		'operator_name'=>'处理人员',
		'updated_at'=>'处理时间',
		'active' => '<span class="label label-success"> 已打款 </span>',
		'applying' => '<span class="label label-warning"> 申请中 </span>',
		'notice' => '<strong>注意!</strong> 当某个角色的用户需要额外权限时添加.',
		'info' => '暂无额外权限',
	],
	'checkin' => [
		'id' => '序号',
		'uid' => '学员id',
		'name' => '姓名',
		'mobile' => '手机号',
		'org_id' => '机构id',
		'org_name' => '机构名称',
		'course_id' => '课程id',
		'course_name' => '课程名称',
		'checkin_time'=>'时间',
		'award_amount'=>'奖励金额',
		'status' => '状态',
		'comment' => '备注',
		'list' => '签到列表',
		'created_at' => '签到时间',
		'updated_at' => '修改时间',
		'active' => '<span class="label label-success"> 已验证 </span>',
		'audit' => '<span class="label label-warning"> 未验证 </span>',
		'notice' => '<strong>注意!</strong> 当某个角色的用户需要额外权限时添加.',
		'info' => '暂无额外权限',
	],
	'invitation' => [
		'id' => '序号',
		'uid' => '邀请人id',
		'name' => '邀请人',
		'mobile' => '手机号',
		'target_uid' => '被邀请人id',
		'target_uname' => '被邀请人',
		'target_mobile' => '被邀请人手机号',
		'register_at'=>'注册时间',
		'authentivation_status'=>'认证状态',
		'enrol_status'=>'报名状态',
		'list' => '邀请列表',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'active' => '<span class="label label-success"> 已验证 </span>',
		'audit' => '<span class="label label-warning"> 未验证 </span>',
		'info' => '暂无额外权限',
	],
	'order' => [
		'id' => '序号',
		'uid' => '学员id',
		'name' => '姓名',
		'mobile' => '手机号',
		'org_id' => '机构id',
		'org_name' => '机构名称',
		'org_account'=>'机构账户id',
		'org_account_name'=>'机构账户姓名',
		'course_id' => '课程id',
		'course_name' => '课程名称',
		'status'=>'状态',
		'operator_id'=>'审核人id',
		'operator_name'=>'审核人',
		'operator_time'=>'审核时间',
		'tuition_amount'=>'缴纳学费',
		'check_in_amount'=>'打卡金额',
		'do_task_amount'=>'任务奖励金额',
		'get_check_in_amount'=>'已打金额',
		'comment'=>'备注',
		'list' => '报名列表',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'end_date' => '截止时间',
		'check_in_days' => '打卡天数',
		'had_check_in_days' => '已打天数',
		'active' => '<span class="label label-success"> 已验证 </span>',
		'audit' => '<span class="label label-warning"> 未验证 </span>',
		'info' => '暂无额外权限',
		'show'=>'查看详情',
		'payback'=>'学习奖励'
	],
	'feedback' => [
		'id' => '序号',
		'name' => '反馈人',
		'content' => '内容',
		'created_at' => '反馈时间',
		'updated_at' => '修改时间',
		'status'=>'状态',
		'list' => '反馈列表',
		'show'=>'查看详情'
	],
	'faq' => [
		'id' => '序号',
		'title' => '标题',
		'content' => '内容',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'sort'=>'排序',
		'status'=>'状态',
		'list' => '问题列表',
		'show'=>'查看详情'
	],
	'appUpdate' => [
		'version_code' => '序号',
		'version_name' => '版本号',
		'instruction' => '更新内容',
		'url' => '下载地址',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'sort'=>'排序',
		'status'=>'状态',
		'list' => '版本列表',
		'show'=>'查看详情'
	],
	'report' => [
		'id' => '序号',
		'title' => '标题',
		'content' => '内容',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'sort'=>'排序',
		'type'=>'类型',
		'status'=>'状态',
		'list' => '报道列表',
		'url'=>'外链地址',
		'show'=>'查看详情'
	],
	'orgapplyfor' => [
		'id' => '序号',
		'name' => '名称',
		'city' => '城市',
		'contacter' => '联系人',
		'address' => '地址',
		'introduce'=>'机构简介',
		'tel_phone'=>'联系电话',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '机构入驻申请列表',
		'confirm' => '已验证',
		'active' => '<span class="label label-success"> 已验证 </span>',
		'audit' => '<span class="label label-warning"> 未验证 </span>',
		'notice' => '<strong>注意!</strong> 当某个角色的用户需要额外权限时添加.',
	],
	'orgrebates' => [
		'id' => '序号',
		'org_id' => '机构',
		'org_name' => '机构名称',
		'student_mobile' => '学生手机号',
		'student_name' => '学生姓名',
		'account' => '金额',
		'operator_name'=>'处理人',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'status'=>'状态',
		'list' => '机构返款列表',
		'show'=>'查看详情',
		'detail'=>'备注详情'
	],

	'drawback' => [
		'id' => '序号',
		'student_mobile' => '学生手机号',
		'student_name' => '学生姓名',
		'order_id' => '订单编号',
		'account' => '金额',
		'operator_name'=>'处理人',
		'course_name'=>'退款课程',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'status'=>'状态',
		'list' => '学生退款列表',
		'show'=>'查看详情',
		'comment'=>'备注详情'
	],


	'banner' => [
		'id' => '序号',
		'url' => '跳转',
		'type' => '类型',
		'sort' => '排序',
		'status' => '状态',
		'img_url'=>'图片',
		'title'=>'标题',
		'list' => '轮播图列表',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
	],

	'traincategory' => [
		'id' => '序号',
		'name' => '名称',
		'desc' => '描述',
		'sort' => '排序',
		'status' => '状态',
		'logo'=>'图片',
		'pid'=>'上级分类',
		'hot' => '热门',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '分类列表',
	],

	'commentorg' => [
		'id' => '序号',
		'user_name' => '评论人',
		'content' => '评论内容',
		'star_counts' => '评分',
		'award_status' => '打赏状态',
		'read_status'=>'阅读状态',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '评论列表',
		'show'=>'查看详情',
		'org_name'=>'评论机构',

	],

	'commentcourse' => [
		'id' => '序号',
		'user_name' => '评论人',
		'content' => '评论内容',
		'star_counts' => '评分',
		'award_status' => '打赏状态',
		'read_status'=>'阅读状态',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '评论列表',
		'show'=>'查看详情',
		'course_name'=>'评论课程',
	],

	'groupbuying' => [
		'id' => '序号',
		'organizer_name' => '发起人',
		'organizer_mobile' => '手机号',
		'course_name' => '课程',
		'org_id' => '所属机构',
		'view_counts' => '浏览量',
		'member_counts' => '参与人数',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '发起时间',
		'show'=>'查看详情',
		'view_counts_flag'=>'完成状态',
		'list' => '开团列表',
	],

	'groupbuyingwords' => [
		'id' => '序号',
		'img_url_app' => '图片(app)',
		'img_url_web' => '图片(web)',
		'desc'=>'描述',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '开团标语列表',
	],
];