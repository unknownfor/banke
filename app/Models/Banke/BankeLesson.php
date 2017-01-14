<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeLesson extends Model
{
    //
    //
    use ActionAttributeTrait;

    protected $table = 'banke_lesson';

    protected $fillable = ['name', 'logo','city', 'cover', 'intro', 'sort', 'address', 'tel_phone',
        'details', 'status'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.lesson.action');
    }
}
