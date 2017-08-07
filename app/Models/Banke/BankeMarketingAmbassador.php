<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeMarketingAmbassador extends Model
{
    // �
    protected $table = 'banke_marketing_ambassador';
    use ActionAttributeTrait;
    protected $fillable = [
        'name',
        'mobile',
        'certification_status',
        'award_amount',
        'status',
        'invitor_id',
        'created_at',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.marketingambassador.action');
    }

    //ʵ����
    public  function invitorAuthen(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','invitor_id');
    }

    //ʵ����
    public  function invitorAuthenSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','invitor_id')->select('uid','real_name');
    }

    //δʵ��
    public  function invitor(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','invitor_id');
    }

    //
    public  function invitorSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','invitor_id')->select('uid','name','avatar','mobile');
    }
}
