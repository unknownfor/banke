<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeMarktingAmbassador extends Model
{
    // »î¶¯
    protected $table = 'banke_markting_ambassador';
    use ActionAttributeTrait;
    protected $fillable = [
        'name',
        'mobile',
        'certification_status',
        'award_amount',
        'status',
        'invitor_id',
        'created_at',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.marktingambassador.action');
    }
}
