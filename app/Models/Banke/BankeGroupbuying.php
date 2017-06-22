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

    //��Ӧ�Ŀγ�
    public  function course(){
        return $this->hasOne('App\Models\Banke\BankeCourse','id','course_id');
    }


    //������ ʵ����
    public  function authenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','organizer_id');
    }

    //������ ʵ����
    public  function authenUserSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','organizer_id')->select('uid','real_name');;
    }

    //������ δʵ��
    public  function user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','organizer_id');
    }

    public  function userSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','organizer_id')->select('uid','name','avatar');
    }

    //��������
    public  function members(){
        return $this->hasMany('App\Models\Banke\BankeGroupbuyingUsers','group_buying_id','id');
    }
}
