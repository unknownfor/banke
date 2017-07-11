<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeEnrol extends Model
{
    //ԤԼ
    use ActionAttributeTrait;
    protected $fillable = [
        'name',
        'status',
        'operator_uid',
        'processing_result',
        'uid','mobile',
        'org_id',
        'org_name',
        'course_id',
        'course_name',
        'invitation_uid',
        'group_buying_id',
        'comment'
    ];

    protected $table = 'banke_enrol';

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.enrol.action');
    }

    public function org()
    {
        return $this->hasOne('App\Models\Banke\BankeOrg','id','org_id');
    }

    public function course()
    {
        return $this->hasOne('App\Models\Banke\BankeCourse','id','course_id');
    }


    //实名后
    public  function authenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid');
    }

    //实名后
    public  function authenUserSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid')->select('uid','real_name');;
    }

    //未实名
    public  function user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid');
    }

    //
    public  function userSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid')->select('uid','name','avatar');
    }



    //邀请人 实名后
    public  function invitorAuthenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','invitation_uid','uid');
    }

    //邀请人 实名后
    public  function invitorAuthenUserSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','invitation_uid','uid')->select('uid','real_name');;
    }

    //邀请人 未实名
    public  function invitorUser(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','invitation_uid','uid');
    }

    //邀请人
    public  function invitorUserSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','invitation_uid','uid')->select('uid','name','avatar');
    }

}
