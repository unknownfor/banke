<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class TaskFormDetailFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'TaskFormDetailRepository';
	}
}