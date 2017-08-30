<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeFreeStudyUsers extends Model
{
    // 免费学成员
    protected $table = 'banke_free_study_users';
    use ActionAttributeTrait;
    protected $fillable = [
        'free_study_id',
        'mobile',
        'uid',
        'status',
        'certification_status',
        'created_at',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.freestudyusers.action');
    }

    public  function freestudy(){
        return $this->hasOne('App\Models\Banke\BankeFreeStudy','id','free_study_id');
    }
}
