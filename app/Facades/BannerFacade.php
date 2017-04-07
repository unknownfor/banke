<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class BannerFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'BannerRepository';
	}
}