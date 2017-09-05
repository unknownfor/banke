<?php

return [

    'common'=>[
        'already_active'    => '该记录已经通过审核，不能重复审核'
    ],

    'permissions' => [
        'created_success'   => '创建权限成功.',
        'created_error'     => '创建权限失败.',
        'updated_success'   => '修改权限成功.',
        'updated_error'     => '修改权限失败.',
        'deleted_success'   => '彻底删除权限成功.',
        'deleted_error'     => '彻底删除权限失败.',
    ],

    'roles' => [
        'created_success'   => '创建角色成功.',
        'created_error'     => '创建角色失败.',
        'updated_success'   => '修改角色成功.',
        'updated_error'     => '修改角色失败.',
        'deleted_success'   => '彻底删除角色成功.',
        'deleted_error'     => '彻底删除角色失败.',
    ],

    'users' => [
        'created_success'   => '创建用户成功.',
        'created_error'     => '创建用户失败.',
        'updated_success'   => '修改用户成功.',
        'updated_error'     => '修改用户失败.',
        'deleted_success'   => '彻底删除用户成功.',
        'deleted_error'     => '彻底删除用户失败.',
        'reset_success'     => '重置用户密码成功.',
        'reset_error'       => '重置用户密码失败.',
        'admin_info_success'=> '修改信息成功.',
        'admin_info_fail'   => '修改信息失败.',
    ],
    'menus' => [
        'laod_success'      => '加载菜单属性成功.',
        'updated_success'   => '修改菜单成功.',
        'updated_error'     => '修改菜单失败.',
        'created_success'   => '创建菜单成功.',
        'created_error'     => '创建菜单失败.',
        'currentItem_error' => '创建菜单失败.',
        'deleted_success'   => '彻底删除菜单成功.',
        'deleted_error'     => '彻底删除菜单失败.',
    ],
    'article' => [
        'updated_success'   => '修改文章成功.',
        'updated_error'     => '修改文章失败.',
        'created_success'   => '创建文章成功.',
        'created_error'     => '创建文章失败.',
        'soft_deleted_success' => '删除文章成功',
        'deleted_success'   => '彻底删除文章成功.',
        'deleted_error'     => '彻底删除文章失败.',
    ],

    'article_category' => [
        'updated_success'   => '修改文章分类成功.',
        'updated_error'     => '修改文章分类失败.',
        'created_success'   => '创建文章分类成功.',
        'created_error'     => '创建文章分类失败.',
        'soft_deleted_success' => '删除文章分类成功',
    ],
    'serviceBusy' => '服务器繁忙，请稍后再试...',
    'deleteTitle' => '确定要彻底删除么?',

    'orgsummary' => [
        'updated_success'   => '修改机构成功.',
        'updated_error'     => '修改机构失败.',
        'created_success'   => '创建机构成功.',
        'created_error'     => '创建机构失败.',
        'deleted_success'   => '删除机构成功.',
        'deleted_error'     => '删除机构失败.',
        'soft_deleted_success' => '删除机构成功',
    ],

    'org' => [
        'updated_success'   => '修改机构成功.',
        'updated_error'     => '修改机构失败.',
        'created_success'   => '创建机构成功.',
        'created_error'     => '创建机构失败.',
        'deleted_success'   => '删除机构成功.',
        'deleted_error'     => '删除机构失败.',
        'soft_deleted_success' => '删除机构成功',
    ],
    'course' => [
        'updated_success'   => '修改课程成功.',
        'updated_error'     => '修改课程失败.',
        'created_success'   => '创建课程成功.',
        'created_error'     => '创建课程失败.',
        'deleted_success'   => '删除课程成功.',
        'deleted_error'     => '删除课程失败.',
        'soft_deleted_success' => '删除课程成功',
    ],
    'app_user' => [
        'updated_success'   => '修改用户成功.',
        'updated_error'     => '修用户失败.',
        'soft_deleted_success' => '删除用户成功',
        'certificate_success'   => '处理用户认证成功',
        'certificate_error'   => '处理用户认证失败'
    ],
    'news' => [
        'updated_success'   => '修改动态成功.',
        'updated_error'     => '修改动态失败.',
        'created_success'   => '创建动态成功.',
        'created_error'     => '创建动态失败.',
        'soft_deleted_success' => '删除动态成功',
    ],
    'dict' => [
        'updated_success'   => '修改配置成功.',
        'updated_error'     => '修改配置失败.',
        'created_success'   => '创建配置成功.',
        'created_error'     => '创建配置失败.',
        'soft_deleted_success' => '删除配置成功',
    ],
    'enrol' => [
        'updated_success'   => '修改预约报名成功.',
        'updated_error'     => '修改预约报名失败.',
        'created_success'   => '创建预约报名成功.',
        'created_error'     => '创建预约报名失败.',
        'soft_deleted_success' => '删除预约报名成功',
    ],
    'order' => [
        'updated_success'   => '修改报名成功.',
        'updated_error'     => '修改报名失败.',
        'created_success'   => '创建报名成功.',
        'created_error'     => '创建报名失败.',
        'soft_deleted_success' => '删除报名成功',
        'soft_deleted_error' => '删除报名失败',
        'authen_success'   => '审核报名成功.',
        'authen_error'     => '审核报名失败.',
        'already_active'    => '该订单已经通过审核，不能重复审核'
    ],
    'orderdeposit' => [
        'updated_success'   => '修改订金成功.',
        'updated_error'     => '修改订金失败.',
    ],
    'withdraw' => [
        'updated_success'   => '审核提现成功.',
        'updated_error'     => '审核提现失败.',
        'soft_deleted_success' => '删除提现成功',
        'soft_deleted_error' => '删除提现失败',
        'financial_updated_error'=>'操作失败,运营部门尚未审核通过'
    ],

    'feedback' => [
        'updated_success'   => '修改反馈成功.',
        'updated_error'     => '修改反馈失败.',
        'soft_deleted_success' => '删除反馈成功',
        'soft_deleted_error' => '删除反馈失败',
    ],
    'faq' => [
        'created_success'   => '创建问题成功.',
        'created_error'     => '创建问题失败.',
        'updated_success'   => '修改问题成功.',
        'updated_error'     => '修改问题失败.',
        'soft_deleted_success' => '删除问题成功',
        'soft_deleted_error' => '删除问题失败',
    ],
    'checkin' => [
        'updated_success'   => '修改签到成功.',
        'updated_error'     => '修改签到失败.',
        'soft_deleted_success' => '删除签到成功',
        'soft_deleted_error' => '删除签到失败',
    ],
    'appUpdate' => [
        'updated_success'   => '修改升级信息成功.',
        'updated_error'     => '修改升级信息失败.',
        'soft_deleted_success' => '删除升级信息成功',
        'soft_deleted_error' => '删除升级信息失败',
    ],
    'report' => [
        'created_success'   => '创建报道成功.',
        'created_error'     => '创建报道失败.',
        'updated_success'   => '修改报道成功.',
        'updated_error'     => '修改报道失败.',
        'soft_deleted_success' => '删除报道成功',
        'soft_deleted_error' => '删除报道失败',
    ],

    'orgapplyfor' => [
        'updated_success'   => '审核机构申请成功.',
        'updated_error'     => '审核机构申请失败.',
        'created_success'   => '创建机构申请成功.',
        'created_error'     => '创建机构申请失败.',
        'deleted_success'   => '删除机构申请成功.',
        'deleted_error'     => '删除机构申请失败.',
    ],

    'orgrebates' => [
        'created_success'   => '创建返款成功.',
        'created_error'     => '创建返款失败.',
        'updated_success'   => '修改返款成功.',
        'updated_error'     => '修改返款失败.',
        'soft_deleted_success' => '删除返款成功',
        'soft_deleted_error' => '删除返款失败',
    ],

    'drawback' => [
        'created_success'   => '创建退款成功.',
        'created_error'     => '创建退款失败.',
        'updated_success'   => '修改退款成功.',
        'updated_error'     => '修改退款失败.',
        'soft_deleted_success' => '删除退款成功',
        'soft_deleted_error' => '删除退款失败',
    ],

    'banner' => [
        'created_success'   => '创建banner成功.',
        'created_error'     => '创建banner失败.',
        'updated_success'   => '修改banner成功.',
        'updated_error'     => '修改banner失败.',
        'soft_deleted_success' => '删除banner成功',
        'soft_deleted_error' => '删除banner失败',
    ],

    'traincategory' => [
        'created_success'   => '创建分类成功.',
        'created_error'     => '创建分类失败.',
        'updated_success'   => '修改分类成功.',
        'updated_error'     => '修改分类失败.',
        'soft_deleted_success' => '删除分类成功',
        'soft_deleted_error' => '删除分类失败',
    ],

    'commentorg' => [
        'updated_success'   => '审核评论成功.',
        'updated_error'     => '审核评论失败.',
        'soft_deleted_success' => '删除评论成功',
        'soft_deleted_error' => '删除评论失败',
    ],

    'groupbuyingwords' => [
        'created_success'   => '创建开团标语成功.',
        'created_error'     => '创建开团标语失败.',
        'updated_success'   => '编辑开团标语成功.',
        'updated_error'     => '编辑开团标语失败.',
        'deleted_success' => '删除开团标语成功',
        'deleted_error' => '删除开团标语失败',
    ],

    'moneystrategy' => [
        'created_success'   => '创建赚钱攻略成功.',
        'created_error'     => '创建赚钱攻略失败.',
        'updated_success'   => '编辑赚钱攻略成功.',
        'updated_error'     => '编辑赚钱攻略失败.',
        'deleted_success' => '删除赚钱攻略成功',
        'deleted_error' => '删除赚钱攻略失败',
    ],

    'alertbox' => [
        'created_success'   => '创建提示成功.',
        'created_error'     => '创建提示失败.',
        'updated_success'   => '编辑提示成功.',
        'updated_error'     => '编辑提示失败.',
        'deleted_success' => '删除提示成功',
        'deleted_error' => '删除提示失败',
    ],

    'moneynews' => [
        'created_success'   => '创建赚钱动态成功.',
        'created_error'     => '创建赚钱动态失败.',
        'updated_success'   => '编辑赚钱动态成功.',
        'updated_error'     => '编辑赚钱动态失败.',
        'deleted_success' => '删除赚钱动态成功',
        'deleted_error' => '删除赚钱动态失败',
    ],

    'recruiteteacher' => [
        'updated_success'   => '审核招生老师成功.',
        'updated_error'     => '审核招生老师失败.',
        'deleted_success' => '删除招生老师成功',
        'deleted_error' => '删除招生老师失败',
    ],

    'activity' => [
        'created_success'   => '创建活动成功.',
        'created_error'   => '创建活动失败.',
        'updated_success'   => '更新活动成功.',
        'updated_error'     => '更新活动失败.',
        'deleted_success' => '删除活动成功',
        'deleted_error' => '删除活动失败',
    ],

    'teachingteacher' => [
        'created_success'   => '创建教学老师成功.',
        'created_error'   => '创建教学老师失败.',
        'updated_success'   => '更新教学老师成功.',
        'updated_error'     => '更新教学老师失败.',
        'deleted_success' => '删除教学老师成功',
        'deleted_error' => '删除教学老师失败',
    ],

    'marketingambassador' => [
        'updated_success'   => '审核推广大使成功.',
        'updated_error'     => '更新推广大使失败.',
        'deleted_success' => '删除推广大使成功',
        'deleted_error' => '删除推广大使失败',
    ],

    'commentappstore' => [
        'updated_success'   => '审核评论成功.',
        'updated_error'     => '审核评论失败.',
        'deleted_success' => '删除评论成功',
        'deleted_error' => '删除评论失败',
    ],

    'goodarticle' => [
        'created_success'   => '创建半课好文成功.',
        'created_error'     => '创建半课好文失败.',
        'deleted_success' => '删除半课好文成功',
        'deleted_error' => '删除半课好文失败',
    ],
    'freestudy' => [
        'created_success'   => '创建免费学成功.',
        'created_error'     => '创建免费学失败.',
        'updated_success'   => '编辑免费学成功.',
        'updated_error'     => '编辑免费学失败.',
        'deleted_success' => '删除免费学成功',
        'deleted_error' => '删除免费学失败',
    ],

    'task' => [
        'created_success'   => '创建任务类型成功.',
        'created_error'     => '创建任务类型失败.',
        'updated_success'   => '编辑任务类型成功.',
        'updated_error'     => '编辑任务类型失败.',
        'deleted_success' => '删除任务类型成功',
        'deleted_error' => '删除任务类型失败',
    ],

    'taskform' => [
        'created_success'   => '创建任务期数成功.',
        'created_error'     => '创建任务期数失败.',
        'updated_success'   => '编辑任务期数成功.',
        'updated_error'     => '编辑任务期数失败.',
        'deleted_success' => '删除任务期数成功',
        'deleted_error' => '删除任务期数失败',
    ],
    'taskformdetail' => [
        'created_success'   => '创建任务成功.',
        'created_error'     => '创建任务失败.',
        'already_created_error'     => '创建失败,目标期数任务已经存在',
        'updated_success'   => '编辑任务成功.',
        'updated_error'     => '编辑任务失败.',
        'deleted_success' => '删除任务成功',
        'deleted_error' => '删除任务失败',
    ],

];