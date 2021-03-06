<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeOrg extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_org';

    protected $fillable = ['name', 'logo','city', 'cover','album', 'intro', 'sort', 'address', 'tel_phone','tel_phone2',
        'details', 'status','short_name','student_counts','cash_back_desc','comment_award',
        'pid',
        'lon',
        'lat',
        'share_comment_org_counts',
        'share_comment_org_award',
        'default_share_count',
        'default_browse_count',
        'default_appointment_users_count',
        'branch_school',
        'qrcode',
        'qrcode_desc',
        'eable_location_checkin',
        'location_checkin_distance',
        'installment_flag',
        'installment_title',
        'installment_content',
        'refund_flag',
        'refund_title',
        'refund_content'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.org.action');
    }

    //1对多个课程
    public function course()
    {
        return $this->hasMany('App\Models\Banke\BankeCourse','org_id','id');
    }

    //1对多个标签
    public function tags()
    {
        return $this->hasMany('App\Models\Banke\BankeOrgTags','oid','id');
    }
    //1对多个分类
    public function categories()
    {
        return $this->hasMany('App\Models\Banke\BankeOrgCategory','oid','id');
    }

    //1对多个评价
    public function comments()
    {
        return $this->hasMany('App\Models\Banke\BankeCommentOrg','org_id','id');
    }

    //父机构
    public function orgsummary()
    {
        return $this->hasOne('App\Models\Banke\BankeOrgSummary','id','pid');
    }
}
