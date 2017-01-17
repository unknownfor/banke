<?php
use Carbon\Carbon;
if(!function_exists('getTime')){
	function getTime($time, $status = True){
		$newTime = new Carbon($time);

		if($status){
			return $newTime->startOfDay();
		}
		return $newTime->endOfDay();
	}
}

/**
 * 判断是否为多维数组
 */
if(!function_exists('isDoubleArray')){
	function isDoubleArray($array){
		if (is_array($array)) {
			foreach ($array as $v) {
				if (is_array($v)) {
					return true;
					break;
				}
			}
			return false;
		}
		return false;
	}
}
/**
 * 验证邮箱
 */
if(!function_exists('confirmEmail')){
	function confirmEmail($confirm){
		if ($confirm == config('admin.global.status.active')) {
			return trans('labels.user.active');
		}
		return trans('labels.user.audit');
	}
}

if(!function_exists('curlRequest')){
	 function curlRequest($url, $postData = array(), $launch = 'post', $contentType = 'text/html') {
		$result = "";
		try {
			$header = array("Content-Type:" . $contentType . ";charset=utf-8");
			if (!empty($_SERVER['HTTP_USER_AGENT'])) {		//是否有user_agent信息
				$user_agent = $_SERVER['HTTP_USER_AGENT'];
			}
			$cur = curl_init();
			curl_setopt($cur, CURLOPT_URL, $url);
			curl_setopt($cur, CURLOPT_HEADER, 0);
 			curl_setopt($cur, CURLOPT_HTTPHEADER, $header);
			curl_setopt($cur, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($cur, CURLOPT_TIMEOUT, 30);
			//https
			curl_setopt($cur, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($cur, CURLOPT_SSL_VERIFYHOST, FALSE);
			if (isset($user_agent)) {
				curl_setopt($cur, CURLOPT_USERAGENT, $user_agent);
			}
			curl_setopt($cur, CURLOPT_ENCODING, 'gzip');
			if (is_array($postData)) {
				if ($postData && count($postData) > 0) {
					$params = http_build_query($postData);
					if ($launch=='get') {		//发送方式选择
						curl_setopt($cur, CURLOPT_HTTPGET, $params);
					} else {
						curl_setopt($cur, CURLOPT_POST, true);
						curl_setopt($cur, CURLOPT_POSTFIELDS, $params);
					}
				}
			} else {
				if (!empty($postData)) {
					$params = $postData;
					if ($launch=='post') {
						curl_setopt($cur, CURLOPT_POST, true);
						curl_setopt($cur, CURLOPT_POSTFIELDS, $params);
					}
				}
			}
			$result = curl_exec($cur);
			curl_close($cur);
		} catch (Exception $e) {

		}
		return $result;
	}
}

/**
 *	金额都保留2位小数，不四舍五入
 */
if(!function_exists('moneyFormat')){
	function moneyFormat($num=null){
		$new_input = sprintf("%.2f",substr(sprintf("%.3f", $num), 0, -1));
		return $new_input;
	}
}

/**
 *	//随机产生六位数密码Begin
 */
if(!function_exists('randCode')){
	function randCode($len=6,$format='ALL'){
		switch($format) {
			case 'ALL':
				$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~'; break;
			case 'CHAR':
				$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~'; break;
			case 'NUMBER':
				$chars='0123456789'; break;
			default :
				$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
				break;
		}
		mt_srand((double)microtime()*1000000*getmypid());
		$password="";
		while(strlen($password)<$len)
			$password.=substr($chars,(mt_rand()%strlen($chars)),1);
		return $password;
	}
}

/**
 * 生成半课用户名
 */
if(!function_exists('createUserName')){
	function createUserName($mobile=null){
		$str = str_random(5);
		$num = substr($mobile, -3);
		return '半课'.$str.$num;
	}
}
