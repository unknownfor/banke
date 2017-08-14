<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeOrgSummaryHotMsg extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_org_summary_hot_msg';

    protected $fillable = ['org_id','name'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.org_summary.action');
    }
}
