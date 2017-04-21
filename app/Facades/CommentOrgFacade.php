<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class CommentOrgFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'CommentOrgRepository';
	}
}