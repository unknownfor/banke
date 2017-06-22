<?php
namespace App\Lib;

class Code {
	const NORMAL_ERROR					= 1;				//报错
	const UNLOGIN						= -1;				//未登陆
	const SUCCESS						= 0;				//成功
	const FATAL_ERROR					= 40000;			//致命错误
	const SIGN_ERROR 					= 40001;			//参数sign错误
	const HTTP_REQUEST_METHOD_ERROR		= 40002;			//请求method错误
	const HTTP_REQUEST_PARAM_ERROR		= 40003;			//请求参数错误
	const WEIXIN_APP_PATNENT_ERROR		= 40004;			//您没有APP支付权限
	const REGISTER_ERROR                  = 50000;			//注册失败
	const LOGIN_ERROR                   	 = 50001;			//登录失败
	const SMSID_ERROR                   	 = 50002;			//验证码错误
	const VERIFY_SMSID_ERROR              = 50003;			//验证码错误
	const RESET_PASSWORD_ERROR            = 50004;			//修改密码失败
	const UPDATE_USER_PROFILE_ERROR      = 50005;			//修改用户资料失败
	const UPDATE_USER_AUTHENTICATION_ERROR      = 50006;			//提交用户认证资料失败
	const ENROL_ERROR     				  = 50007;			//预约报名失败
	const MOBILE_NOT_EXIST_ERROR     		= 50008;			//手机号未注册
	const CREATE_ENROL_ORDER_ERROR     		= 50009;			//创建学生报名订单失败
	const START_CLASS_ERROR     				= 50010;			//开课失败
	const CHECK_IN_AMOUNT_ERROR     			= 50011;			//打卡奖励已领取完毕
	const THE_LESSON_NOT_OPEN_ERROR     	= 50012;			//课程暂未开课
	const CHECK_IN_ERROR     					= 50013;			//打卡失败
	const END_CLASS_ERROR     				= 50014;			//开课失败
	const ALREADY_CHECK_IN_ERROR     		= 50015;			//已经打过卡
	const REGISTER_MOBILE_ERROR     			= 50016;			//手机号格式错误或已注册
	const SEND_SMS_ERROR     					= 50017;			//发送短信失败
	const ORG_ERROR     					= 50018;			//机构信息查询失败

	const MIDDLEWARE_HAS_BEEN_CERTIFIED		= 60001;		//中间件，用户已认证
	const MIDDLEWARE_NOT_BEEN_CERTIFIED		= 60002;		//中间件，用户未认证
	const MIDDLEWARE_NOT_ORG_ACCOUNT		= 60003;		//中间件，非机构账户
	const MIDDLEWARE_NOT_PAY_COURSE			= 60004;		//中间件，没有付费课程，未获得奖励资格

	const UPDATE_VIEW_COUNTS_ERROR			= 60005;		//更新浏览量失败,没有对应的订单

	const PAY_ALI = 1;    // 支付方式 支付宝
	const PAY_WEIXIN = 7;    // 支付方式 微信支付

	public static function errMsg() {
		return array(
			self::NORMAL_ERROR					=>	'接口错误',
			self::UNLOGIN						=>	'未登陆',
			self::SUCCESS						=>	'success',
			self::FATAL_ERROR					=>	'接口错误,请联系管理员',
			self::SIGN_ERROR 					=>	'签名错误',
			self::HTTP_REQUEST_METHOD_ERROR		=>	'api请求方式错误',
			self::HTTP_REQUEST_PARAM_ERROR		=>	'api请求参数错误',
			self::WEIXIN_APP_PATNENT_ERROR      =>  '您没有APP支付权限',
			self::REGISTER_ERROR					=>	'注册失败',
			self::LOGIN_ERROR						=>	'登录失败',
			self::SMSID_ERROR						=>	'验证码有误',
			self::VERIFY_SMSID_ERROR				=>	'验证码有误',
			self::RESET_PASSWORD_ERROR			=>	'修改密码错误',
			self::UPDATE_USER_PROFILE_ERROR		=>	'修改用户资料失败',
			self::UPDATE_USER_AUTHENTICATION_ERROR		=>	'提交用户认证资料失败',
			self::ENROL_ERROR						=>	'预约报名失败',
			self::MOBILE_NOT_EXIST_ERROR			=>	'手机号未注册',
			self::CREATE_ENROL_ORDER_ERROR		=>	'提交学员报名信息失败',
			self::START_CLASS_ERROR				=>	'开课失败',
			self::CHECK_IN_AMOUNT_ERROR			=>	'您的上课打卡奖励已经全部领取完毕',
			self::THE_LESSON_NOT_OPEN_ERROR		=>	'您报名的课程暂未开课',
			self::CHECK_IN_ERROR					=>	'打卡失败',
			self::END_CLASS_ERROR					=>	'结束课程失败',
			self::ALREADY_CHECK_IN_ERROR			=>	'该课程已经打过卡了',
			self::REGISTER_MOBILE_ERROR			=>	'手机号格式错误或已注册',
			self::SEND_SMS_ERROR					=>	'发送短信失败',

			self::MIDDLEWARE_HAS_BEEN_CERTIFIED		=>	'用户已认证',
			self::MIDDLEWARE_NOT_BEEN_CERTIFIED		=>	'用户未认证',
			self::MIDDLEWARE_NOT_ORG_ACCOUNT		=>	'非机构账户无法访问',
			self::MIDDLEWARE_NOT_PAY_COURSE			=>	'您还未获得打卡奖励资格，先去机构报名学习吧',
			self::UPDATE_VIEW_COUNTS_ERROR			=>  '更新浏览量失败,没有对应的订单',
		);
	}



	public static function getErrorMsg($code) {
		$msgArray = self::errMsg();
		return $msgArray[$code];
	}
}