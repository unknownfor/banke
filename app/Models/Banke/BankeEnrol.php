<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeEnrol extends Model
{
    //ԤԼ
    use ActionAttributeTrait;
    protected $fillable = [
        'status',
        'operator_uid',
        'processing_result',
        'uid','mobile',
        'org_id',
        'org_name',
        'course_id',
        'course_name',
        'invitation_uid'
    ];

    protected $table = 'banke_enrol';

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.enrol.action');
    }

    public function org()
    {
        return $this->hasOne('App\Models\Banke\BankeOrg','id','org_id');
    }

    public function course()
    {
        return $this->hasOne('App\Models\Banke\BankeCourse','id','course_id');
    }
}
