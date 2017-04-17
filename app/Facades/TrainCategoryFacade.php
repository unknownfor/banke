<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class TrainCategoryFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'TrainCategoryRepository';
	}
}