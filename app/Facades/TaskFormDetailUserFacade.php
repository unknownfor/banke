<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class TaskFormDetailUserFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'TaskFormDetailUserRepository';
	}
}