<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeMoneyNews extends Model
{
    // ×¬Ç®¶¯Ì¬
    protected $table = 'banke_money_news';
    use ActionAttributeTrait;
    protected $fillable = [
        'business_type',
        'amount',
        'cut_amount',
        'user_name',
        'invited_name',
        'status',
        'user_type',
        'sort',
        'short_name',
        'created_at',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.moneynews.action');
    }
}
