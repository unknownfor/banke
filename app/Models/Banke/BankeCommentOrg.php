<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeCommentOrg extends Model
{
    //
    protected $table = 'banke_comment_org';
    use ActionAttributeTrait;
    protected $fillable = [
        'status','award_status'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.commentorg.action');
    }

    //评论人 实名后
    public  function realUserInfo(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid');
    }

    //评论人 未实名
    public  function userInfo(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid');
    }

    //对应的机构
    public  function orgInfo(){
        return $this->hasOne('App\Models\Banke\BankeOrg','id','org_id');
    }
}
