<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class ReportFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'ReportRepository';
	}
}