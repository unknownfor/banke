<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeGoodArticle extends Model
{
    // °ë¿ÎºÃÎÄÕÂ
    protected $table = 'banke_article';
    use ActionAttributeTrait;
    protected $fillable = [
        'title',
        'cover',
        'intro',
        'url',
        'status',
        'created_at',
        'updated_at',
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.goodarticle.action');
    }
}
