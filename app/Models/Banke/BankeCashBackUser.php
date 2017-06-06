<?php

namespace App\Models\Banke;

use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeCashBackUser extends Model
{
    //报名订单表

    use ActionAttributeTrait;

    protected $fillable = ['order_id', 'uid','name', 'course_name', 'org_id', 'course_id', 'org_account', 'mobile', 'tuition_amount',
        'check_in_amount', 'do_task_amount', 'period', 'comment', 'pay_tuition_time',
        'operator_uid', 'status','check_in_days',
        'share_comment_course_amount',
        'get_share_comment_course_amount',
        'share_comment_org_amount',
        'get_share_comment_org_amount',
        'share_group_buying_amount',
        'get_share_group_buying_amount',
        'share_group_buying_view_counts',
        'share_comment_course_view_counts',
        'share_comment_org_view_counts',
        'share_group_buying_counts',
        'share_comment_course_counts',
        'share_comment_org_counts',
        'group_buying_amount',
        'get_group_buying_amount'

    ];

    private $action;

    protected $table = 'banke_cash_back_users';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.order.action');
    }

    public function org(){
        return $this->hasOne('App\Models\Banke\BankeOrg','id','org_id');
    }

    public function course(){
        return $this->hasOne('App\Models\Banke\BankeCourse','id','course_id');
    }

}
