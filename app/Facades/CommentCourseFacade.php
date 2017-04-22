<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class CommentCourseFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'CommentCourseRepository';
	}
}