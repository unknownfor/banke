<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class TaskFormUserFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'TaskFormUserRepository';
	}
}