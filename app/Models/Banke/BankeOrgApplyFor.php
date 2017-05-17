<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeOrgApplyFor extends Model
{
    use ActionAttributeTrait;
    //
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'banke_org_apply_for';

    protected $fillable = ['name','city','tel_phone','contact','introduce','address','updated_at', 'status'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.orgapplyfor.action');
    }
}
