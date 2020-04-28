<?php
namespace common\components\Notifications\SMS;


use common\components\helpers\BeanstalkHelpers;
use Yii;
use common\models\SmsQueue;


class Sms {

    private $_senderName ;
    private $_message    ;
    private $_to = [];


    public function getSenderName(){
        return $this->_senderName;
    }

    public function getMessage(){
        return $this->_message;
    }

    public function getTo(){
        return $this->_to;
    }

    public function setSenderName($senderName){
        $this->_senderName = $senderName;
    }

    public function addTo($to){

        if(is_string($to)){
            $this->_to[] = $to;
            return;
        }

        if(is_array($to)){
            $this->_to =  array_merge($to,$this->_to);
            return ;
        }

    }

    public function setMessage($message){
        $this->_message = $message;
    }


    public function send(){
        $smsQueue = new SmsQueue();
        $smsQueue->sender_name =  $this->_senderName;
        $smsQueue->to_numbers  =  json_encode($this->_to);
        $smsQueue->message     =  $this->_message;
        $smsQueue->save();
        BeanstalkHelpers::put( ['sms_queue_id'=>$smsQueue->id],Yii::$app->params['BEANSTALK']['TUBES']['SMS_QUEUE']);
    }
}