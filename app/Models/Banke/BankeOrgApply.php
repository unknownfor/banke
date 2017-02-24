<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeOrgApply extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_org_apply';

    protected $fillable = ['name', 'city', 'contacter', 'introduce', 'address', 'tel_phone',
        'updated_at', 'status'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.orgapply.action');
    }
}
