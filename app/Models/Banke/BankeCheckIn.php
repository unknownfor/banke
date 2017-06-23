<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeCheckIn extends Model
{
    //��
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

    //������ ʵ����
    public  function authenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid');
    }

    //������ ʵ����
    public  function authenUserSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid')->select('uid','real_name');;
    }

    //������ δʵ��
    public  function user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid');
    }

    public  function userSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid')->select('uid','name','avatar');
    }

    //����
    public  function org(){
        return $this->hasOne('App\Models\Banke\BankeOrg','id','org_id');
    }

    //�γ�
    public  function course(){
        return $this->hasOne('App\Models\Banke\BankeCourse','id','course_id');
    }
}
