<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class GoodArticleFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'GoodArticleRepository';
	}
}