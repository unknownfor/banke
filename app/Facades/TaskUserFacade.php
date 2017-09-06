<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class TaskUserFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'TaskUserRepository';
	}
}