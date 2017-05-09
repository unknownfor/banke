<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeCheckIn extends Model
{
    //打卡
    //    //
    use ActionAttributeTrait;

    protected $table = 'banke_check_in';

    protected $fillable = [ 'status', 'comment'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.checkin.action');
    }

    //评论人 实名后
    public  function authenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid');
    }

    //评论人 未实名
    public  function user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid');
    }

    //机构
    public  function org(){
        return $this->hasOne('App\Models\Banke\BankeOrg','id','org_id');
    }

    //课程
    public  function course(){
        return $this->hasOne('App\Models\Banke\BankeCourse','id','course_id');
    }
}
