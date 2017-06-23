<?php

namespace App\Models\Banke;

use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeOrderDeposit extends Model
{
    //报名订单表

    use ActionAttributeTrait;

    protected $fillable = [
        'course_id',
        'course_name',
        'org_id',
        'org_name',
        'mobile',
        'pay_type',
        'pay_status',
        'course_price',
        'status',
        'order_no',
        'created_at',
        'updated_at',
        'transaction_no',
        'account'
    ];

    private $action;

    protected $table = 'banke_order_deposit';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.orderdeposit.action');
    }

    public function org(){
        return $this->hasOne('App\Models\Banke\BankeOrg','id','org_id');
    }

    public function course(){
        return $this->hasOne('App\Models\Banke\BankeCourse','id','course_id');
    }

    //评论人 实名后
    public  function authenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','mobile','mobile');
    }

    //评论人 未实名
    public  function user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','mobile','mobile');
    }

}
