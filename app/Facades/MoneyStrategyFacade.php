<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class MoneyStrategyFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'MoneyStrategyRepository';
	}
}