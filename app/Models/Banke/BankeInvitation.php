<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeInvitation extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_invitation';

    protected $fillable = ['name', 'uid', 'name', 'mobile', 'target_mobile', 'status', 'certification_status', 'enrol_status'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.invitation.action');
    }
}
