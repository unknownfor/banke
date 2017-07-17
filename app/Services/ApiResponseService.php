<?php

namespace App\Services;

use  App\Lib\Code;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

class ApiResponseService {

	public static function success($data,$code,$message)
	{
		$result = [
			'data' 		=> $data,
			'status_code' 		=> $code,
			'message' 	=> $message	
		];
		return response()->json($result);
	}

	public static function showError($code) {

		$message = Code::getErrorMsg($code);
		$result = [
			'data' 		=> '',
			'status_code' 		=> $code,
			'message' 	=> $message
		];
		return response()->json($result);

	}



	public static function post($url,$param)
	{
		$header = [
			'headers' => [
				'Content-Type' => 'application/json'
			]
		];
		$http = new Client();

		$response = $http->request('post',$url, $param);
		$code = $response->getStatusCode();
		if ($code == 200)
		{
			return $response;
		}
	}


	public static function get($url)
	{
		$http = new Client();
		$response = $http->request('get',$url);
		$code = $response->getStatusCode();
		if ($code == 200)
		{
			$body = $response->getBody();
			$result = json_decode((string)$body,true);
			return $result;
		}
	}

	public static function http_post($url, $param, $post_file = false)
	{
		$oCurl = curl_init();
		if (stripos($url, "https://") !== FALSE) {
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
		}
		if (PHP_VERSION_ID >= 50500 && class_exists('\CURLFile')) {
			$is_curlFile = true;
		} else {
			$is_curlFile = false;
			if (defined('CURLOPT_SAFE_UPLOAD')) {
				curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, false);
			}
		}

		if ($post_file) {
			if ($is_curlFile) {
				foreach ($param as $key => $val) {
					if (isset($val["tmp_name"])) {
						$param[$key] = new \CURLFile(realpath($val["tmp_name"]), $val["type"], $val["name"]);
					} else if (substr($val, 0, 1) == '@') {
						$param[$key] = new \CURLFile(realpath(substr($val, 1)));
					}
				}
			}
			$strPOST = $param;
		} else {
			$strPOST = json_encode($param);
		}

		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($oCurl, CURLOPT_POST, true);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
		curl_setopt($oCurl, CURLOPT_VERBOSE, 1);
		curl_setopt($oCurl, CURLOPT_HEADER, 1);

		$sContent = self::execCURL($oCurl);
		curl_close($oCurl);
		return $sContent;
	}

	public static function execCURL($ch)
	{
		$response = curl_exec($ch);
		$error = curl_error($ch);
		$result = array('header' => '',
			'content' => '',
			'curl_error' => '',
			'http_code' => '',
			'last_url' => '');

		if ($error != "") {
			$result['curl_error'] = $error;
			return $result;
		}
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$result['header'] = str_replace(array("\r\n", "\r", "\n"), "<br/>", substr($response, 0, $header_size));
		$result['content'] = substr($response, $header_size);
		$result['http_code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$result['last_url'] = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		$result["base_resp"] = array();
		$result["base_resp"]["ret"] = $result['http_code'] == 200 ? 0 : $result['http_code'];
		$result["base_resp"]["err_msg"] = $result['http_code'] == 200 ? "ok" : $result["curl_error"];

		return $result;
	}
}


