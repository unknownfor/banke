<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeOrgSummary extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_org_summary';

    protected $fillable = ['name', 'category_id','surperior', 'short_name','logo', 'intro', 'sort',
        'details', 'status','created_at','updated_at'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.orgsummary.action');
    }

    //1对多个课程
    public function org()
    {
        return $this->hasMany('App\Models\Banke\BankeOrg','pid','id');
    }

    //1对多个分类
    public function category()
    {
        return $this->hasOne('App\Models\Banke\BankeTrainCategory','id','category_id');
    }
}
