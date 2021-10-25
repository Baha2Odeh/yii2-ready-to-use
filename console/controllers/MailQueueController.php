<?php

namespace console\controllers;

use common\models\EmailQueue;
use Pheanstalk\Exception;
use Yii;
use Pheanstalk\Pheanstalk;

class MailQueueController extends Controller
{
    public function actionIndex()
    {

        $category = 'appcCommands.MailQueue';
        $sleeping = 5;
        $pheanstalk = new Pheanstalk(Yii::$app->params['BEANSTALK']['HOST'] . ':' . Yii::$app->params['BEANSTALK']['PORT']);
        $closeTime = time() + 1800;
        while($closeTime > time()) {
            try {
                $job = $pheanstalk
                    ->watch(Yii::$app->params['BEANSTALK']['TUBES']['MAIL_QUEUE'])
                    ->ignore('default')
                    ->reserve(1);
                if (empty($job)) {
                    echo "Queue Empty ... sleeping for $sleeping seconds";
                    Yii::info("Queue Empty ... sleeping for $sleeping seconds", $category);
                    sleep($sleeping);
                    continue;
                }
                $data = (array)json_decode($job->getData());
                if (empty($data)) {
                    echo "Queue Empty ... sleeping for $sleeping seconds";
                    Yii::info("Queue Empty ... sleeping for $sleeping seconds", $category);
                    sleep($sleeping);
                    continue;
                }
                $mailDataObject = EmailQueue::findOne($data['mail_id']);
                if (!empty($mailDataObject) AND is_object($mailDataObject)) {
                    Yii::$app->language = $mailDataObject->language_code;
                    Yii::$app->mailer
                        ->compose()
                        ->setSubject($mailDataObject->subject)
                        ->setFrom((array)json_decode($mailDataObject->from_address))
                        ->setTo(json_decode($mailDataObject->to_address,true))
                        ->setHtmlBody(Yii::$app->controller->renderPartial('@common/mail/' . Yii::$app->mailer->htmlLayout, ['content' => $mailDataObject->message]))
                        ->setBcc(json_decode($mailDataObject->bcc_address))
                        ->send();
                    $mailDataObject->sent = 1;
                    $mailDataObject->sent_at = date('Y-m-d h:i:s');
                    $mailDataObject->save();
                    $pheanstalk->delete($job);
                } else {
                    echo " will delete ... its not an object or its empty EMAIL#" . $data['mail_id'];
                    Yii::warning(" will delete ... its not an object or its empty EMAIL#" . $data['mail_id'], $category);
                    $pheanstalk->delete($job);
                }
            } catch (Exception $e) {
                echo ". Exception: " . $e->getMessage();
                Yii::error("Exception in " . basename(__FILE__) . ". Exception: " . $e->getMessage(), $category);
            }
        }
    }


}