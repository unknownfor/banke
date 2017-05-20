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

    //������ ʵ����
    public  function authenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','organizer_id');
    }

    //������ δʵ��
    public  function user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','organizer_id');
    }

    //��Ӧ�Ŀγ�
    public  function course(){
        return $this->hasOne('App\Models\Banke\BankeCourse','id','course_id');
    }

    //��Ӧ�Ļ���
    public  function org(){
        return $this->hasOne('App\Models\Banke\BankeOrg','id','org_id');
    }
}
