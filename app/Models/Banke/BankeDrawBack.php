<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeDrawback extends Model
{
    use ActionAttributeTrait;
    //
    /**
     * 与模型关联的数据表  学生退款
     *
     * @var string
     */
    protected $table = 'banke_drawback';

    protected $fillable = ['student_mobile', 'order_id','account', 'operator_id','comment','status','updated_at'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.drawback.action');
    }
}
