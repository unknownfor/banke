<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeCourse extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_course';

    protected $fillable = ['name', 'org_id', 'cover', 'price','period',
        'intro', 'sort', 'details', 'status','checkin_award','task_award','z_award_amount'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.course.action');
    }

    public function org()
    {
        return $this->hasOne('App\Models\Banke\BankeOrg','id','org_id');
    }
}
