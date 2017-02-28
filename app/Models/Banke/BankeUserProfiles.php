<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeUserProfiles extends Model
{
    //    //±¨Ãû
    use ActionAttributeTrait;

    protected $primaryKey = 'uid';

    protected $table = 'banke_user_profiles';

    protected $fillable = ['uid', 'name', 'mobile', 'avatar', 'sex', 'certification_status','org_id','invitation_code',
        'account_balance',
        'total_cashback_amount',
        'check_in_amount',
        'do_task_amount',
        'withdrawal_amount',
        'invitation_count',
        'register_amount',
        'invitation_amount',
        'certification_time',
        ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.app_user.action');
    }
}
