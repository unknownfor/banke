<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeTrainCategory extends Model
{
    //
    protected $table = 'banke_train_category';
    use ActionAttributeTrait;
    protected $fillable = [
        'pid', 'sort', 'status','logo','name','hot','desc','short_name'
    ];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.traincategory.action');
    }
}
