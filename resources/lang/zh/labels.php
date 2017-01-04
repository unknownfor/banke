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
		'dictList' => '<i class="fa fa-bars"></i> 配置列表',
		'dictCreate' => '<i class="fa fa-user-plus"></i> 创建配置',
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
		'logo'=>'Logo',
		'intro'=>'一句话简介',
		'city' => '城市',
		'address' => '地址',
		'cover'=>'封面',
		'details'=>'详情',
		'tel_phone'=>'联系电话',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'order'=>'排序',
		'list' => '机构列表',
		'courseList' => '课程列表',

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
		'org_id'=>'所属机构id',
		'price'=>'参考价',
		'real_price' => '成交价',
		'cover'=>'封面',
		'detail'=>'课程介绍',
		'percent'=>'优惠比例',
		'sort'=>'排序',
		'status' => '状态',
		'created_at' => '创建时间',
		'updated_at' => '修改时间',
		'list' => '课程列表',
		'confirm' => '已验证',
		'active' => '<span class="label label-success"> 已验证 </span>',
		'audit' => '<span class="label label-warning"> 未验证 </span>',
		'notice' => '<strong>注意!</strong> 当某个角色的用户需要额外权限时添加.',
		'info' => '暂无额外权限',
	],
];