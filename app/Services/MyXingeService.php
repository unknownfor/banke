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
     * Ⱥ������
     * @param $msgInfo ������Ϣ��
     * title������
     * content:����
     * custom��������key val �� array ��ʽ
     */
    public  function pushGroupMsg($msgInfo)
    {
        $this->pushGroupMsgAndroid($msgInfo);
        $this->pushGroupMsgIOS($msgInfo);
    }

    /**
     * androidȺ��
     * @param $msgInfo  ������Ϣ��
     * @return array|mixed ret-code:0 ��ʾ���ͳɹ�
     */
    private function pushGroupMsgAndroid($msgInfo){


        $push = new XingeApp(config('xinge.accessIdAndroid'), config('xinge.secretKeyAndroid'));
        $mess = new Message();
        $mess->setType(Message::TYPE_NOTIFICATION);
        $title="���";
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
     * iosȺ��
     * @param $msgInfo  ������Ϣ��
     * @return array|mixed ret-code:0 ��ʾ���ͳɹ�
     */
    private function pushGroupMsgIOS($msgInfo)
    {
        /*  	IOSȫ��*/
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
     * @param $msgInfo ������Ϣ��
     * title������
     * content:����
     * custom��������key val �� array ��ʽ
     * uid���û�id
     */
    public  function pushSingleMsg($msgInfo)
    {
        $this->pushSingleMsgAndroid($msgInfo);
        $this->pushSingleMsgIOS($msgInfo);
    }

    /**
     * �Ƶ���android
     */
    private function pushSingleMsgAndroid($msgInfo){
        $push = new XingeApp(config('xinge.accessIdAndroid'), config('xinge.secretKeyAndroid'));
        $mess = new Message();
        $mess->setType(Message::TYPE_NOTIFICATION);
        $title="���";
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
     * �Ƶ���ios
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