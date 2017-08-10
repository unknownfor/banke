<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class CommentAppStoreFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'CommentAppStoreRepository';
	}
}