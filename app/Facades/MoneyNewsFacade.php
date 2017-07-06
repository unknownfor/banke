<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class MoneyNewsFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'MoneyNewsRepository';
	}
}