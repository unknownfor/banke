<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class InvitationFacade extends Facade
{
	protected static function getFacadeAccessor(){
		return 'InvitationRepository';
	}
}