<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class OrgSummaryFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'OrgSummaryRepository';
	}
}