<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class AppUpdateFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'AppUpdateRepository';
	}
}