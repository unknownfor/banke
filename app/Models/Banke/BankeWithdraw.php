<?php

namespace App\Models\Banke;
use App\Models\ActionAttributeTrait;
use Illuminate\Database\Eloquent\Model;

class BankeWithdraw extends Model
{
    //
    use ActionAttributeTrait;
    //
    /**提现
     * * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'banke_withdraw';

    protected $fillable = ['status', 'operator_uid', 'processing_result','initial_status','initial_operator_id'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.withdraw.action');
    }
    public function  userAuthen(){
        return $this->hasOne('App\Models\Banke\BankeUserAuthentication','uid','uid');
    }
    public function  user(){
        return $this->hasOne('App\Models\Banke\BankeUserProfiles','uid','uid');
    }

    public function  operator(){
        return $this->hasOne('App\Models\Banke\BankeUsers', 'id', 'operator_uid');
    }
}
