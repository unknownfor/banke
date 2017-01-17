<?php

namespace App\Services;

use  App\Lib\Code;

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
}


