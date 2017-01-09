<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class EnrolFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'EnrolRepository';
	}
}