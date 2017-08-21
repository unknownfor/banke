<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeSpecialMobile extends Model
{
    // ÌØÊâµÄÕËºÅ
    protected $table = 'banke_special_mobile';
    use ActionAttributeTrait;
    protected $fillable = [
        'mobile',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.activity.action');
    }

    public  function userSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','mobile','mobile')->select('uid','name','avatar');
    }
}
