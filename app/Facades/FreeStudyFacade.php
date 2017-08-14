<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class FreeStudyFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'FreeStudyRepository';
	}
}