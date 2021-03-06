<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeTaskFormUser extends Model
{
    // 每个人对应的当前任务
    protected $table = 'banke_task_form_user';
    use ActionAttributeTrait;
    protected $fillable = [
        'task_form_id',
        'user_id',
        'status',
        'current_seq',
        'time_begin',
        'time_end',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.taskform.action');
    }
}
