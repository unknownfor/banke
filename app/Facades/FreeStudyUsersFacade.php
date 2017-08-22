<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class FreeStudyUsersFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'FreeStudyUsersRepository';
	}
}