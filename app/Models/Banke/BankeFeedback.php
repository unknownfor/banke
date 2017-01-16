<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeFeedback extends Model
{
    use ActionAttributeTrait;
    //
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'banke_feedback';

    protected $fillable = ['name', 'content', 'uid', 'status','created_at'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.feedback.action');
    }
}
