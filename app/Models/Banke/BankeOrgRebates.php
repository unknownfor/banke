<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeOrgRebates extends Model
{
    use ActionAttributeTrait;
    //
    /**
     * 与模型关联的数据表  机构返款
     *
     * @var string
     */
    protected $table = 'banke_org_rebates';

    protected $fillable = ['org_id', 'student_mobile', 'account', 'operator_id','status','detail'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.orgrebates.action');
    }
}
