<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class CheckinFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'CheckinRepository';
	}
}