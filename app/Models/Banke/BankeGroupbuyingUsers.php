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

    //��Ӧ����
    public  function groupbuying(){
        return $this->hasOne('App\Models\Banke\BankeGroupbuying','id','group_buying_id');
    }


    //������ ʵ����
    public  function authenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid');
    }

    //������ δʵ��
    public  function user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid');
    }
}
