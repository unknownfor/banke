<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class ActivityFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'ActivityRepository';
	}
}