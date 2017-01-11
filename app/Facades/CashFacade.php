<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class CashFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'CashRepository';
	}
}