<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeMoneyStrategy extends Model
{
    // ÕõÇ®¹¥ÂÔ
    protected $table = 'banke_money_strategy';
    use ActionAttributeTrait;
    protected $fillable = [
        'title',
        'content',
        'sort',
        'status',
        'type',
        'cover_img',
        'author',
        'created_at',
        'updated_at',
        'author'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.moneystrategy.action');
    }
}
