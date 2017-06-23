<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class OrderDepositFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'OrderDepositRepository';
	}
}