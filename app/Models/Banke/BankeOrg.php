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

    //1�Զ���γ�
    public function course()
    {
        return $this->hasMany('App\Models\Banke\BankeCourse','oid','id');
    }

    //1�Զ����ǩ
    public function tags()
    {
        return $this->hasMany('App\Models\Banke\BankeOrgTags','oid','id');
    }

    //1�Զ������
    public function categories()
    {
        return $this->hasMany('App\Models\Banke\BankeOrgCategory','oid','id');
    }
}
