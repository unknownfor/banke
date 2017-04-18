<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeOrgTags extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_org_tags';

    protected $fillable = ['oid','name'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.org.action');
    }
}
