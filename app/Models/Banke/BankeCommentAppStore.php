<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeCommentAppStore extends Model
{
    //
    protected $table = 'banke_comment_appstore';
    use ActionAttributeTrait;
    protected $fillable = [
        'certification_status',
        'updated_at'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.commentappstore.action');
    }

    //评论人 实名后
    public  function authenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid');
    }
    //评论人 实名后
    public  function authenUserSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid')->select('uid','real_name');
    }

    //评论人 未实名
    public  function user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid');
    }
    public  function userSimple(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid')->select('uid','mobile','avatar','name');
    }


    //对应的机构
    public  function org(){
        return $this->hasOne('App\Models\Banke\BankeOrg','id','org_id');
    }
}
