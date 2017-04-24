<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeCommentCourse extends Model
{
    //
    protected $table = 'banke_comment_course';
    use ActionAttributeTrait;
    protected $fillable = [
        'status','award_status','operator_id'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.commentcourse.action');  //��Ӧconfig�ļ�
    }

    //������ ʵ����
    public  function authenUser(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid');
    }

    //������ δʵ��
    public  function user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid');
    }

    //������ δʵ��
    public  function course(){
        return $this->hasOne('App\Models\Banke\BankeCourse','id','course_id');
    }
}
