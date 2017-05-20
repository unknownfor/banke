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
        'status','view_counts','member_counts'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.groupbuying.action');
    }

    //评论人 实名后
    public  function authenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','organizer_id');
    }

    //评论人 未实名
    public  function user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','organizer_id');
    }

    //对应的课程
    public  function course(){
        return $this->hasOne('App\Models\Banke\BankeCourse','id','course_id');
    }

    //对应的机构
    public  function org(){
        return $this->hasOne('App\Models\Banke\BankeOrg','id','org_id');
    }
}
