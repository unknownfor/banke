<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeAppUpdate extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_app_update';

    protected $fillable = ['version_code','version_name', 'instruction', 'url', 'status'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.appUpdate.action');
    }
}
