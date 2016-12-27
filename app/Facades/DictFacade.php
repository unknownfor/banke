<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class DictFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'DictRepository';
	}
}