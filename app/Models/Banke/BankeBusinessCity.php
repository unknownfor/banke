<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeBusinessCity extends Model
{
    // »î¶¯
    protected $table = 'banke_business_city';
    use ActionAttributeTrait;
    protected $fillable = [
        'name',
        'sort',
        'status',
        'created_at',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.activity.action');
    }
}
