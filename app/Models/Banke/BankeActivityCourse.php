<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeActivityCourse extends Model
{
    // »î¶¯
    protected $table = 'banke_activity_course';
    use ActionAttributeTrait;
    protected $fillable = [
        'activity_id',
        'course_id',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.activity.action');
    }
}
