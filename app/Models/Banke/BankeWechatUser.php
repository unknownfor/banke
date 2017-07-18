<?php

namespace App\Models\Banke;

use Illuminate\Database\Eloquent\Model;

class BankeWechatUser extends Model {

	protected $table = 'banke_wechat_user';

	protected $fillable = ['openid','nickname','sex','province','city','country','headimgurl'];

}
