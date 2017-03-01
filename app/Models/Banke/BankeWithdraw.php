<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeWithdraw extends Model
{
    //
    use ActionAttributeTrait;
    //
    /**提现
     * * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'banke_withdraw';

    protected $fillable = ['status', 'operator_uid', 'processing_result'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.withdraw.action');
    }
}
