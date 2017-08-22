<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeOrgSummary extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_org_summary';

    protected $fillable = ['name',
        'category_id',
        'surperior',
        'short_name',
        'logo',
        'intro',
        'sort',
        'details',
        'url',
        'city',
        'fake_enrol_counts',
        'fake_signup_counts',
        'fake_comment_count',
        'fake_consult_ranking',
        'course_avg_price',
        'grade_total',
        'grade_env',
        'grade_profession',
        'grade_service',
        'grade_effect',
        'status',
        'created_at',
        'updated_at',
        'installment_flag',
        'installment_title',
        'refund_flag',
        'refund_title',
        'album',

    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.orgsummary.action');
    }

    //1对多个多个子机构
    public function org()
    {
        return $this->hasMany('App\Models\Banke\BankeOrg','pid','id');
    }

    //1对多个分类
    public function category()
    {
        return $this->hasOne('App\Models\Banke\BankeTrainCategory','id','category_id');
    }

    //1对多个标签
    public function tags()
    {
        return $this->hasMany('App\Models\Banke\BankeOrgSummaryTags','oid','id');
    }

    //1对多个热门消息
    public function hotmsg()
    {
        return $this->hasMany('App\Models\Banke\BankeOrgSummaryHotMsg','org_id','id');
    }

    //1对多个老师
    public function teachers()
    {
        return $this->hasMany('App\Models\Banke\BankeTeachingTeacher','org_id','id');
    }
}
