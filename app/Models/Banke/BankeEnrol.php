<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeEnrol extends Model
{
    //
    use ActionAttributeTrait;
    protected $fillable = [ 'status', 'operator_uid', 'processing_result'];

    protected $table = 'banke_enrol';

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.enrol.action');
    }
}
