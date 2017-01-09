<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeNews extends Model
{
    //
    use ActionAttributeTrait;
    protected $fillable = ['title', 'content', 'status', 'sort'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.news.action');
    }
}
