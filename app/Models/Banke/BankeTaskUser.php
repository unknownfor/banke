<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeTaskUser extends Model
{
    // 任务期数表
    protected $table = 'banke_task_user';
    use ActionAttributeTrait;
    protected $fillable = [
        'task_id',
        'user_id',
        'source_Id',
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
