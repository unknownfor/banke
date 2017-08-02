<?php
namespace App\Repositories\admin;
use Carbon\Carbon;
use Flash;
use App\Models\Banke\BankeBusinessCity;
use Illuminate\Support\Facades\Log;

/**
* 合作城市仓库
*/
class BusinessCityRepository
{
	public static  function getAllBusinessCity()
	{
		return BankeBusinessCity::where('status',1)->orderBy("sort")->get(['name']);
	}
}