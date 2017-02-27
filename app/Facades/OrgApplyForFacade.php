<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class OrgApplyForFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'OrgApplyForRepository';
	}
}