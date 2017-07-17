<?php

namespace App\Services;

use Cache;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

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
        $param = [
            'body' => [
                'appid'=>'wxd31c411080b18c74',
                'secret'=>'5ba59209da79f0f601e661f56b787d96',
                'js_code'=>$code,
                'grant_type'=>'authorization_code'
            ]
        ];
        $url = config('web.global.wxPayParams.get_open_id_url').
            '?appid='.config('web.global.wxPayParams.appid').
            '&secret='.config('web.global.wxPayParams.secret').
            '&js_code='.$code.'&grant_type=authorization_code';
        $result = ApiResponseService::get($url);
        return $result;
    }


    /*存储用户信息*/
    private function saveUser($wxInfo){
        $openid = $wxInfo['openid'];
        $user = User::where('openid',$openid);
        if ($user->count()==0)
        {
            $newUser=new User;
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