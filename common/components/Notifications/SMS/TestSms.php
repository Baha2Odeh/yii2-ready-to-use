<?php
namespace common\components\Notifications\SMS;


use common\models\User;
use Yii;


class TestSms extends Sms{

    /**
     * @return self
     */
    public static function getInstance(){
        return new self();
    }
    public function __construct(){
       $this->setSenderName(Yii::$app->params['SMS']['SENDER_NAME']);
    }

    public function sendWelcomeSms(User $user){
        $this->addTo($user->phone_number);
        $this->setMessage(Yii::t('app', "Welcome"));
        $this->send();
    }



}