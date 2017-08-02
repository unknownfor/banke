<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class BusinessCityFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'BusinessCityRepository';
	}
}