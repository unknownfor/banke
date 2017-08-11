<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeTeachingTeacher extends Model
{
    //
    protected $table = 'banke_teaching_teacher';
    use ActionAttributeTrait;
    protected $fillable = [
        'uid',
        'org_id',
        'sub_org_id',
        'name',
        'avatar',
        'goodat_course',
        'intro',
        'album',
        'tags',
        'status',
        'created_at',
        'updated_at',
        'sort'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.teachingteacher.action');
    }

    public function org()
    {
        return $this->hasOne('App\Models\Banke\BankeOrg','id','sub_org_id');
    }
    public function orgSummary()
    {
        return $this->hasOne('App\Models\Banke\BankeSummaryOrg','id','org_id')->select('id','name');
    }
}
