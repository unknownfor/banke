<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeBanner extends Model
{
    //
    protected $table = 'banke_banner';
    use ActionAttributeTrait;
    protected $fillable = [
        'url', 'type', 'sort', 'status','img_url'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.banner.action');
    }
}
