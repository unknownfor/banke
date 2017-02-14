<?php

namespace App\Models\Banke;

use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeCashBackUser extends Model
{
    //±¨Ãû

    use ActionAttributeTrait;

    protected $fillable = ['order_id', 'uid','name', 'course_name', 'org_id', 'course_id', 'org_account', 'mobile', 'tuition_amount',
        'check_in_amount', 'do_task_amount', 'period', 'comment', 'pay_tuition_time',
        'operator_uid', 'status'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.order.action');
    }
}
