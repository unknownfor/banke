<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeTaskFormDetailUser extends Model
{
    // 每个人对应的当前任务
    protected $table = 'banke_task_form_detail_user';
    use ActionAttributeTrait;
    protected $fillable = [
        'times_finished',
        'times_needed',
        'award_coin'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.taskform.action');
    }
}
