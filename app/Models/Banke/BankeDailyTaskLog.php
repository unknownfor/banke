<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeDailyTaskLog extends Model
{
    // 每日任务表
    protected $table = 'banke_daily_task_log';
    use ActionAttributeTrait;
    protected $fillable = [
        'uid',
        'mobile',
        'total_counts',
        'today_counts',
        'task_type',
        'status',
        'created_at',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.dailytasklog.action');
    }
}
