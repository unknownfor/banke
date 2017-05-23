<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class GroupbuyingFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'GroupbuyingRepository';
	}
}