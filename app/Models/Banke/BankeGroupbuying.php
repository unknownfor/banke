<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeGroupbuying extends Model
{
    //
    protected $table = 'banke_group_buying';
    use ActionAttributeTrait;
    protected $fillable = [
        'status','view_counts','view_counts_flag','lastly_finished_at'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.groupbuying.action');
    }

    //对应的课程
    public  function course(){
        return $this->hasOne('App\Models\Banke\BankeCourse','id','course_id');
    }


    //评论人 实名后
    public  function authenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','organizer_id');
    }

    //评论人 实名后
    public  function authenUserSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','organizer_id')->select('uid','real_name');;
    }

    //评论人 未实名
    public  function user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','organizer_id');
    }

    public  function userSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','organizer_id')->select('uid','name','avatar');
    }

    //参团人数
    public  function members(){
        return $this->hasMany('App\Models\Banke\BankeGroupbuyingUsers','group_buying_id','id');
    }
}
