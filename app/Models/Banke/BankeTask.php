<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeTask extends Model
{
    // 任务总类型表
    protected $table = 'banke_task';
    use ActionAttributeTrait;
    protected $fillable = [
        'time_end',
        'memo',
        'name',
        'type',
        'title',
        'cycle',
        'award_coin',
        'award_type',
        'status',
        'created_at',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.task.action');
    }
}
