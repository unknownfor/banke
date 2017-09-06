<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class MesssageFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'MesssageRepository';
	}
}