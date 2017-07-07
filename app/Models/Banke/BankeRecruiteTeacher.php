<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeRecruiteTeacher extends Model
{
    // ÕÐÉúÀÏÊ¦
    protected $table = 'banke_recruite_teacher';
    use ActionAttributeTrait;
    protected $fillable = [
        'org_id',
        'status',
        'operator_id',
        'status',
        'comment',
        'updated_at'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.recruiteteacher.action');
    }

    public  function userSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid')->select('uid','mobile','avatar');
    }


}
