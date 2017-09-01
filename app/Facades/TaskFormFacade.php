<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class TaskFormFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'TaskFormRepository';
	}
}