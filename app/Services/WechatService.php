<?php

namespace App\Services;

use Cache;

class WechatService
{
    public function send_weixn($content)
    {
        $msg = array(
            'touser' => "",
            'toparty' => '2',
            'msgtype' => 'text',
            'agentid' => config('workweixin.agentid'),
            'text' => array(
                "content" => $content,
            )
        );

        $corpid = config('workweixin.corpid');
        $app_secret = config('workweixin.app_secret');
        $app_access_token = $this->getAccessToken($corpid, $app_secret);
        //$sst=file_get_contents("https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token=$app_access_token&id=");//获取部门企业微信部门信息
        //$nnt=file_get_contents("https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token=$app_access_token&department_id=2&fetch_child=");//获取具体部门下人员的信息
        //var_dump($nnt);die;
        $url = "https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=$app_access_token";
        $this->http_post($url, $msg);

    }

    public function getAccessToken($corpid, $app_secret)
    {
        $weixin_access_token = Cache::get('weixin_access_token');
        if ($weixin_access_token == null) {
            $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$corpid&corpsecret=$app_secret";
            $res = json_decode(file_get_contents($url));
            $weixin_access_token = $res->access_token;
            Cache::put('weixin_access_token', $weixin_access_token, 60);
        }
        return $weixin_access_token;
    }


    public function http_post($url, $param, $post_file = false)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        if (PHP_VERSION_ID >= 50500 && class_exists('\CURLFile')) {
            $is_curlFile = true;
        } else {
            $is_curlFile = false;
            if (defined('CURLOPT_SAFE_UPLOAD')) {
                curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, false);
            }
        }

        if ($post_file) {
            if ($is_curlFile) {
                foreach ($param as $key => $val) {
                    if (isset($val["tmp_name"])) {
                        $param[$key] = new \CURLFile(realpath($val["tmp_name"]), $val["type"], $val["name"]);
                    } else if (substr($val, 0, 1) == '@') {
                        $param[$key] = new \CURLFile(realpath(substr($val, 1)));
                    }
                }
            }
            $strPOST = $param;
        } else {
            $strPOST = json_encode($param);
        }

        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        curl_setopt($oCurl, CURLOPT_VERBOSE, 1);
        curl_setopt($oCurl, CURLOPT_HEADER, 1);

        $sContent = $this->execCURL($oCurl);
        curl_close($oCurl);
        return $sContent;
    }

    public function execCURL($ch)
    {
        $response = curl_exec($ch);
        $error = curl_error($ch);
        $result = array('header' => '',
            'content' => '',
            'curl_error' => '',
            'http_code' => '',
            'last_url' => '');

        if ($error != "") {
            $result['curl_error'] = $error;
            return $result;
        }
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $result['header'] = str_replace(array("\r\n", "\r", "\n"), "<br/>", substr($response, 0, $header_size));
        $result['content'] = substr($response, $header_size);
        $result['http_code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $result['last_url'] = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        $result["base_resp"] = array();
        $result["base_resp"]["ret"] = $result['http_code'] == 200 ? 0 : $result['http_code'];
        $result["base_resp"]["err_msg"] = $result['http_code'] == 200 ? "ok" : $result["curl_error"];

        return $result;
    }
}