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

    protected $fillable = ['uid', 'name', 'avatar', 'sex'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.user_profiles.action');
    }
}
