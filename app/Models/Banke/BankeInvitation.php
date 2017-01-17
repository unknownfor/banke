<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeInvitation extends Model
{
    use ActionAttributeTrait;
    //
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'banke_invitation';

    protected $fillable = ['uid', 'name', 'status', 'mobile', 'target_mobile'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.invitation.action');
    }
}
