<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeCheckIn extends Model
{
    //
    //
    use ActionAttributeTrait;

    protected $table = 'banke_check_in';

    protected $fillable = ['name', 'logo','city', 'cover', 'intro', 'sort', 'address', 'tel_phone',
        'details', 'status'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.checkin.action');
    }
}
