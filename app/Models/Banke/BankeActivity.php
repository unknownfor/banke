<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeActivity extends Model
{
    // �
    protected $table = 'banke_activity';
    use ActionAttributeTrait;
    protected $fillable = [
        'title',
        'cover',
        'desc',
        'url_type',
        'url',
        'cover_img',
        'city',
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
