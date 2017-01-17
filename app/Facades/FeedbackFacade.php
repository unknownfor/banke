<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class FeedbackFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'FeedbackRepository';
	}
}