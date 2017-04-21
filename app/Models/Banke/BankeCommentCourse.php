<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeCommentCourse extends Model
{
    //
    protected $table = 'banke_commnet_course';
    use ActionAttributeTrait;
    protected $fillable = [
        'status','operator_id'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.course.action');
    }
}
