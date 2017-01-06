<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeDict extends Model
{
    use ActionAttributeTrait;
    //
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'banke_dict';

    protected $fillable = ['key', 'value', 'status', 'description'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.dict.action');
    }
}
