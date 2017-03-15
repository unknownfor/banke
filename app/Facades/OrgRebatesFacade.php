<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class OrgRebatesFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'OrgRebatesRepository';
	}
}