<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeCourseCategory extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_course_category';

    protected $fillable = ['cid'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.course.action');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Banke\BankeTrainCategory','id','cid');
    }
}
