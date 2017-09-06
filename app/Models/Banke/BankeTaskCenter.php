<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeTaskCenter extends Model
{
    // 任务期数表
    protected $table = 'banke_task_center';
    use ActionAttributeTrait;
    protected $fillable = [

    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.taskform.action');
    }
}
