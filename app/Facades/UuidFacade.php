<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class UuidFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'Uuid';
	}
}