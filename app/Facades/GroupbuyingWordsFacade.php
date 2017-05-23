<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class GroupbuyingWordsFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'GroupbuyingWordsRepository';
	}
}