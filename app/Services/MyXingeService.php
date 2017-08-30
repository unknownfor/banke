<?php
/**
 * Created by PhpStorm.
 * User: jimmy-hisihi
 * Date: 2017/8/28
 * Time: 17:25
 */

namespace App\Services;

use App\Services\XingeApp;
use App\Services\Message;
use App\Services\MessageIOS;

class MyXingeService
{
    /**
     * 群发消息
     * @param $msgInfo 消息体信息
     * title标题（安卓叶才会使用）
     * content消息内容
     * custom 自定义参数 key val 的 array 对象
     */
    public  function pushGroupMsg($msgInfo)
    {
        $this->pushGroupMsgAndroid($msgInfo);
        $this->pushGroupMsgIOS($msgInfo);
    }

    /**
     * android 群发消息
     * @param $msgInfo  消息体信息
     * @return array|mixed ret-code:0 发送成功
     */
    private function pushGroupMsgAndroid($msgInfo){


        $push = new XingeApp(config('xinge.accessIdAndroid'), config('xinge.secretKeyAndroid'));
        $mess = new Message();
        $mess->setType(Message::TYPE_NOTIFICATION);
        $title="半课";
        if(!empty($msgInfo['title'])){
            $title=$msgInfo['title'];
        }
        $mess->setTitle($title);
        $mess->setContent($msgInfo['content']);
        $mess->setExpireTime(86400);
        if(!empty($msgInfo['custom'])) {
            $mess->setCustom($msgInfo['custom']);
        }
        $ret = $push->PushAllDevices(0, $mess);
        return $ret;
    }

    /**
     * ios群发消息
     * @param $msgInfo  消息体信息
     * @return array|mixed ret-code:0 发送成功
     */
    private function pushGroupMsgIOS($msgInfo)
    {
        $push = new XingeApp(config('xinge.accessIdIOS'), config('xinge.secretKeyIOS'));
        $mess = new MessageIOS();
        $mess->setExpireTime(86400);
        $mess->setAlert($msgInfo['content']);
        if(!empty($msgInfo['custom'])) {
            $mess->setCustom($msgInfo['custom']);
        }
        $ret = $push->PushAllDevices(0, $mess, XingeApp::IOSENV_DEV);
        return $ret;
    }


    /**
     * @param $msgInfo 单点推送
     * title 标题
     * content:内容
     * custom 自定义参数 key val 键值对形式 array
     * uid用户id
     */
    public  function pushSingleMsg($msgInfo)
    {
        $this->pushSingleMsgAndroid($msgInfo);
//        $this->pushSingleMsgIOS($msgInfo);
    }

    /**
     * 单发android
     */
    private function pushSingleMsgAndroid($msgInfo){
//        $push = new XingeApp(config('xinge.accessIdAndroid'), config('xinge.secretKeyAndroid'));
//        $mess = new Message();
//        $mess->setType(Message::TYPE_NOTIFICATION);
//        $title="半课";
//        if(!empty($msgInfo['title'])){
//            $title=$msgInfo['title'];
//        }
//        $mess->setTitle($title);
//        $mess->setContent($msgInfo['content']);
//        $mess->setExpireTime(86400);
//        if(!empty($msgInfo['custom'])) {
//            $mess->setCustom($msgInfo['custom']);
//        }
//        $res=$push->PushSingleAccount(0, $msgInfo['uid'], $mess);
//        return $res;
        $push = new XingeApp(config('xinge.accessIdAndroid'), config('xinge.secretKeyAndroid'));
        $mess = new Message();
        $mess->setType(Message::TYPE_NOTIFICATION);
        $mess->setTitle("半课");
        $mess->setContent("学军是个屌丝！！！哈哈哈");
        $mess->setExpireTime(86400);
        $custom = array('key1'=>'111', 'key2'=>'222');
        $mess->setCustom($custom);
        $res=$push->PushSingleAccount(0, 210, $mess);
        return $res;
    }

    /**
     * 单发ios
     */
    private function pushSingleMsgIOS($msgInfo){
           $push = new XingeApp(config('xinge.accessIdIOS'), config('xinge.secretKeyIOS'));
           $mess = new MessageIOS();
           $mess->setExpireTime(86400);
           $mess->setAlert($msgInfo['content']);
            if(!empty($msgInfo['custom'])) {
                $mess->setCustom($msgInfo['custom']);
            }
           $res = $push->PushSingleAccount(0, $msgInfo['uid'], $mess,XingeApp::IOSENV_DEV);
    }
}