<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class FaqFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'OrgRebatesRepository';
	}
}