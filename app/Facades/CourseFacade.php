<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class CourseFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'CourseRepository';
	}
}