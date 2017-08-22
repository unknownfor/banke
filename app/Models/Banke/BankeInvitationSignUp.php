<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeInvitationSignUp extends Model
{
    use ActionAttributeTrait;
    //
    /**
     * 邀请报名的记录表
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'banke_invitation_signup';

    protected $fillable = [
        'uid',
        'course_id',
        'course_name',
        'tuition_amount',
        'invitor_id',
        'invitor_award_amount',
        'status',
        'created_at',
        'updated_at'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.invitation.action');
    }
}
