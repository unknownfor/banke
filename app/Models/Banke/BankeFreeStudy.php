<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeFreeStudy extends Model
{
    // Ãâ·ÑÑ§
    protected $table = 'banke_free_study';
    use ActionAttributeTrait;
    protected $fillable = [
        'title',
        'shot_content',
        'content',
        'img_url',
        'type',
        'url',
        'sort',
        'status',
        'fake_signup_count',
        'created_at',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.freestudy.action');
    }
}
