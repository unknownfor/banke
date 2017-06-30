<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class RecruiteTeacherFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'RecruiteTeacherRepository';
	}
}