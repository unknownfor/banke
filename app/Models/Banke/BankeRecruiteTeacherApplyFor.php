<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeRecruiteTeacherApplyFor extends Model
{
    //
    use ActionAttributeTrait;
    protected $fillable = ['mobile', 'invitation_uid'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
