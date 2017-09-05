<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeTaskCard extends Model
{
    // ²¹Áì¿¨±í
    protected $table = 'banke_task_card';
    use ActionAttributeTrait;
    protected $fillable = [
        'id',
        'user_id',
        'card_count',
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
