<?php
namespace App\Repositories\admin;
use App\Models\Banke\BankeMessage;
use Carbon\Carbon;
use Flash;
use DB;
use App\Repositories\admin\AppUserRepository;
use League\Flysystem\Exception;

/**
*	系统消息
*/
class MessageRepository
{

	/*添加新的系统消息记录*/
	public static function addNewMessage($input){
		$message=null;

		//消息记录
		switch($input['task_id']){
			case 9:
				$message=self::shareMessage($input);
				break;
			default:
				break;
		}

		//记录消息
		BankeMessage::create($message);
	}

	private static function shareMessage($input){
		//消息记录
		$message = [
			'status' => 0,
			'uid' => $input['user_id'],
			'title' => '分享奖励',
			'content' => '感谢您分享的好文章,平台已奖励您' . $input['award'] . '元现金，快去现金钱包里查看吧！',
			'type' => config('admin.global.balance_log')[13]['key']
		];
		return $message;
	}
	
}