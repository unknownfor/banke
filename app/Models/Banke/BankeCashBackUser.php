<?php

namespace App\Models\Banke;

use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeCashBackUser extends Model
{
    //
    use ActionAttributeTrait;

    protected $fillable = ['uid', 'org_id', 'course_id', 'tuition_amount', 'cash_back_amount',
        'operator_uid', 'status'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.app_user.action');
    }
}
