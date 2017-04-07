<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeOrg extends Model
{
    //
    use ActionAttributeTrait;

    protected $table = 'banke_org';

    protected $fillable = ['name', 'logo','city', 'cover','album', 'intro', 'sort', 'address', 'tel_phone',
        'details', 'status','short_name','student_counts'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.org.action');
    }

    public function course()
    {
        return $this->hasMany('App\Models\Banke\BankeCourse','org_id')->withTimestamps();
    }
}
