<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeGroupbuyingUsers extends Model
{
    //
    protected $table = 'banke_group_buying_users';
    use ActionAttributeTrait;
    protected $fillable = [
        'uid','group_buying_id','created_at'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.groupbuying.action');
    }

    //对应的团
    public  function groupbuying(){
        return $this->hasOne('App\Models\Banke\BankeGroupbuying','id','group_buying_id');
    }


    //评论人 实名后
    public  function authenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid');
    }

    //评论人 未实名
    public  function user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid');
    }
}
