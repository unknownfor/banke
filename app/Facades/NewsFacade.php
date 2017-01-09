<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class NewsFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'NewsRepository';
	}
}