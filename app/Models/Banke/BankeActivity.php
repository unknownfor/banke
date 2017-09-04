<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeActivity extends Model
{
    // 活动
    protected $table = 'banke_activity';
    use ActionAttributeTrait;
    protected $fillable = [
        'title',
        'cover',
        'content',
        'url_type',
        'url',
        'cover_img',
        'city',
        'sort',
        'status',
        'created_at',
        'updated_at',
        'out_url_type',//外链类型
        'click_img_url', //可点击的图片 对应的图片地址
        'click_url' //可点击的图片 对应的图片地址
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.activity.action');
    }
}
