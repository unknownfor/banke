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
     * 群发推送
     * @param $msgInfo 推送消息体
     * title：标题
     * content:内容
     * custom：参数，key val 的 array 形式
     */
    public  function pushGroupMsg($msgInfo)
    {
        $this->pushGroupMsgAndroid($msgInfo);
        $this->pushGroupMsgIOS($msgInfo);
    }

    /**
     * android群发
     * @param $msgInfo  推送消息体
     * @return array|mixed ret-code:0 表示发送成功
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
     * ios群发
     * @param $msgInfo  推送消息体
     * @return array|mixed ret-code:0 表示发送成功
     */
    private function pushGroupMsgIOS($msgInfo)
    {
        /*  	IOS全部*/
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
     * @param $msgInfo 推送消息体
     * title：标题
     * content:内容
     * custom：参数，key val 的 array 形式
     * uid：用户id
     */
    public  function pushSingleMsg($msgInfo)
    {
        $this->pushSingleMsgAndroid($msgInfo);
        $this->pushSingleMsgIOS($msgInfo);
    }

    /**
     * 推单个android
     */
    private function pushSingleMsgAndroid($msgInfo){
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
        $res=$push->PushSingleAccount(0, $msgInfo['uid'], $mess);
        return $res;
    }

    /**
     * 推单个ios
     */
    private function pushSingleMsgIOS($msgInfo){
           $push = new XingeApp(config('xinge.accessIdIOS'), config('xinge.secretKeyIOS'));
           $mess = new MessageIOS();
           $mess->setExpireTime(86400);
           $mess->setAlert($msgInfo['content']);
            if(!empty($msgInfo['custom'])) {
                $mess->setCustom($msgInfo['custom']);
            }
           $push->PushSingleAccount(0, $msgInfo['uid'], $mess,XingeApp::IOSENV_DEV);
    }
}