<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeUserAuthentication extends Model
{
    //

    use ActionAttributeTrait;

    protected $primaryKey = 'uid';

    protected $table = 'banke_user_authentication';

    protected $fillable = ['uid', 'real_name', 'school', 'major', 'grade', 'mobile', 'birthday',
        'zhifubao_account', 'certification_picture', 'certification_status'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.app_user.action');
    }

    //个人资料信息
    public function profiles(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles', 'uid');
    }
}
