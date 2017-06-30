<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeBanner extends Model
{
    // ÕõÇ®¹¥ÂÔ
    protected $table = 'banke_money_strategy';
    use ActionAttributeTrait;
    protected $fillable = [
        'title', 'content', 'sort', 'status','img_url','title'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.moneystrategy.action');
    }
}
