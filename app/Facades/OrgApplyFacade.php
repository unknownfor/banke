<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class OrgApplyFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'OrgApplyRepository';
	}
}