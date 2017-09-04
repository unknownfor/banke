<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeTaskFormDetail extends Model
{
    // »î¶¯
    protected $table = 'banke_task_form_detail';
    use ActionAttributeTrait;
    protected $fillable = [
        'task_id',
        'task_form_id',
        'name',
        'memo',
        'seq_no',
        'award_coin',
        'flag',
        'task_boxes',
        'times_needed',
        'created_at',
        'updated_at'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.taskformdetail.action');
    }

    public  function tasktype()
    {
        return $this->hasOne('App\Models\Banke\BankeTask','id','task_id');
    }

    public  function taskform()
    {
        return $this->hasOne('App\Models\Banke\BankeTaskForm','id','task_form_id');
    }
}
