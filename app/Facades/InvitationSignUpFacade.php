<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class InvitationSignUpFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'InvitationSignUpRepository';
	}
}