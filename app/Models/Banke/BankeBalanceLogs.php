<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeBalanceLogs extends Model
{
    // Óà¶îÃ÷Ï¸
    protected $table = 'banke_balance_logs';
    use ActionAttributeTrait;

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.activity.action');
    }
}
