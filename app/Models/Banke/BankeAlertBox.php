<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeAlertBox extends Model
{
    // ÕõÇ®¹¥ÂÔ
    protected $table = 'banke_alert_box';
    use ActionAttributeTrait;
    protected $fillable = [
        'title',
        'content',
        'status',
        'user_type',
        'created_at',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.alertbox.action');
    }
}
