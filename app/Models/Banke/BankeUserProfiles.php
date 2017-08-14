<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeUserProfiles extends Model
{
    //    //����
    use ActionAttributeTrait;

    protected $primaryKey = 'uid';

    protected $table = 'banke_user_profiles';
    protected $fillable = ['uid',
        'name',
        'mobile',
        'avatar',
        'sex',
        'certification_status',
        'org_id',
        'user_type',
        'invitation_code',
        'invitation_uid',
        'account_balance',
        'total_cashback_amount',
        'check_in_amount',
        'do_task_amount',
        'withdraw_amount',
        'invitation_count',
        'register_amount',
        'invitation_amount',
        'certification_time',
        'enddated_at',
        'total_withdraw_amount',
        'get_do_task_amount',
        'invitation_order_uid'
        ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.app_user.action');
    }

    public function withdraws()
    {
        return $this->hasMany('App\Models\Banke\BankeWithDraw','uid','uid');
    }
    public function authentication()
    {
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid');
    }
}
