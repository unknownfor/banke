<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class TeachingTeacherFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'TeachingTeacherRepository';
	}
}