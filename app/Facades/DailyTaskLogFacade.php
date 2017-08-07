<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class DailyTaskLogFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'DailyTaskLogRepository';
	}
}