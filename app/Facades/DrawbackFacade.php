<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class DrawbackFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'DrawbackRepository';
	}
}