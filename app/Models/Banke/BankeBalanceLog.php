<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeBalanceLog extends Model
{
    //
    //
    use ActionAttributeTrait;

    protected $fillable = [ 'uid', 'change_amount', 'change_type', 'business_type', 'operator_uid'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.balanceLog.action');
    }
}
