<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class WithdrawFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'WithdrawRepository';
	}
}