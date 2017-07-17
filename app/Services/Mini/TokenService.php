<?php

namespace App\Services\Mini;

use Cache;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Services\ApiResponseService;
use App\Models\Banke\BankeWechatUser;

class TokenService {

    /**获得Token**/
    public function getToken($code)
    {
        $token=csrf_token();
        $wxInfo=self::getWxInfo($code);

        //将结果存入到系统缓存中
        Cache::put($token, json_encode($wxInfo), config('mini.global.wxPayParams.token_cache_expired'));

        //将openid记录到数据库中
        self::saveUser($wxInfo);
        return $token;
    }

    /*验证token*/
    public function verifyToken($token)
    {
        $wxInfo = Cache::get($token);
        if($wxInfo){
            return true;
        }
        else{
            return false;
        }
    }

    /*根据token来获取openid*/
    public function getOpenIdByToken($token){
        $wxInfo=Cache::get($token);
        if($wxInfo){
            return json_decode($wxInfo,true)['openid'];
        }
        return false;

    }

    /*调用微信服务器获得用户的openid和secretkey*/
    private static function getWxInfo($code)
    {
        $url = 'https://api.weixin.qq.com/sns/jscode2session?'.
            'appid='.config('mini.global.wxpay.appid').
            '&secret='.config('mini.global.wxpay.secret').
            '&js_code='.$code.'&grant_type=authorization_code';
        $result = ApiResponseService::http_post($url,null);
        return json_decode($result['content']);
    }


    /*存储用户信息*/
    private function saveUser($wxInfo){
        $openid = $wxInfo->openid;
        $user = BankeWechatUser::where('openid',$openid);
        if ($user->count()==0)
        {
            $newUser=new BankeWechatUser;
            $newUser->openid=$openid;
            if($newUser->save()) {
                return $newUser->id;
            }
        }
        else {
            $user=$user->first();
            return $user->id;
        }
    }

}