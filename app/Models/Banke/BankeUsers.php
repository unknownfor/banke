<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeUsers extends Model
{
    //    //����
    use ActionAttributeTrait;

    protected $primaryKey = 'id';

    protected $table = 'users';

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.app_user.action');
    }
}
