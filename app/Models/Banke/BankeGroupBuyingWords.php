<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeGroupbuyingWords extends Model
{
    //
    protected $table = 'banke_group_buying_words';
    use ActionAttributeTrait;
    protected $fillable = ['img_url_app', 'img_url_web', 'status', 'desc','created_at','updated_at'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.groupbuyingwords.action');
    }
}
