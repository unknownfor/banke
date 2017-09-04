<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeTaskForm extends Model
{
    // 任务期数表
    protected $table = 'banke_task_form';
    use ActionAttributeTrait;
    protected $fillable = [
        'name',
        'seq_no',
        'user_type',
        'time_end',
        'status',
        'created_at',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.taskform.action');
    }
}
