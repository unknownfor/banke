<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeMoneyStrategy extends Model
{
    // ��Ǯ����
    protected $table = 'banke_money_strategy';
    use ActionAttributeTrait;
    protected $fillable = [
        'title',
        'content',
        'sort',
        'status',
        'user_type',
        'cover_img',
        'author',
        'created_at',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.moneystrategy.action');
    }
}
