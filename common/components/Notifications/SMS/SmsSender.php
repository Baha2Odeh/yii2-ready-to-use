<?php

namespace common\components\Notifications\SMS;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client as TwilioClient;
use Yii;

class SmsSender
{

    public static function send($senderName, $to, $message)
    {


        try {
            $client = new TwilioClient(Yii::$app->params['SMS']['PROVIDERS']['TWILIO']['SID'], Yii::$app->params['SMS']['PROVIDERS']['TWILIO']['TOKEN']);
            $client->messages->create($to, ['from' => $senderName, 'body' => $message]);
        } catch (ConfigurationException $e) {

        }


    }
}