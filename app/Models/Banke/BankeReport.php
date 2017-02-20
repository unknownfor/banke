<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeReport extends Model
{
    use ActionAttributeTrait;
    //
    /**
     * 与模型关联的数据表   媒体报道
     *
     * @var string
     */
    protected $table = 'banke_report';

    protected $fillable = ['title', 'status', 'sort', 'content','type','url'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.report.action');
    }
}
