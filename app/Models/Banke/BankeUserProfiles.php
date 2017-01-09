<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeUserProfiles extends Model
{
    //
    use ActionAttributeTrait;

    protected $primaryKey = 'uid';

    protected $table = 'banke_user_profiles';

    protected $fillable = ['uid', 'name', 'avatar', 'sex', 'account_balance', 'register_amount',
        'certification_status', 'certification_time'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.app_user.action');
    }
}
