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
        'status',''
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.org.action');
    }
}
