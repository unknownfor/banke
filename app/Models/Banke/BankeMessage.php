<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeMessage extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_message';

    protected $fillable = [ 'uid', 'title', 'content', 'status', 'type'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.message.action');
    }
}
