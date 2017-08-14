<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeOrgSummaryTags extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_org_summary_tags';

    protected $fillable = ['oid','name'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.org_summary.action');
    }
}
