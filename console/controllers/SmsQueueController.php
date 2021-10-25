<?php
namespace console\controllers;


use common\models\SmsQueue;
use yii\helpers\Console;
use Yii;
use Pheanstalk\Pheanstalk;

class SmsQueueController  extends Controller
{
    public function actionIndex(){
        $category = 'appcCommands.SMSQueue';
        $sleeping = 5;
        $pheanstalk = new Pheanstalk( Yii::$app->params['BEANSTALK']['HOST'] . ':' . Yii::$app->params['BEANSTALK']['PORT']);
        $closeTime = time() + 1800;
        while($closeTime > time()) {
            try {

                $job = $pheanstalk
                    -> watch( Yii::$app -> params['BEANSTALK']['TUBES']['SMS_QUEUE'] )
                    -> ignore( 'default' )
                    -> reserve(1);
                if(empty($job)){
                    echo  "Queue Empty ... sleeping for $sleeping seconds";
                    Yii::info( "Queue Empty ... sleeping for $sleeping seconds", $category );
                    sleep( $sleeping );
                    continue;
                }
                $data = (array)json_decode($job->getData());
                if ( empty($data)  ) {
                    echo  "Queue Empty ... sleeping for $sleeping seconds";
                    Yii::info( "Queue Empty ... sleeping for $sleeping seconds", $category );
                    sleep( $sleeping );
                    continue;
                }

                $smsDataObject = SmsQueue::findOne($data['sms_queue_id']);

                if( !empty( $smsDataObject ) AND is_object( $smsDataObject ) ){
                    $to  = implode(',',json_decode($smsDataObject->to_numbers));
                    \common\components\Notifications\SMS\SmsSender::send(
                        $smsDataObject->sender_name,
                        $to,
                        $smsDataObject->message

                    );
                    $smsDataObject->sent = 1;
                    $smsDataObject->sent_at = date('Y-m-d h:i:s');
                    $smsDataObject->save();
                    $pheanstalk->delete($job);

                }else{
                    echo " will delete ... its not an object or its empty EMAIL#".$data['mail_id'];
                    Yii::warning( " will delete ... its not an object or its empty EMAIL#".$data['mail_id'], $category );
                    $pheanstalk->delete($job);
                }



            }  catch(\Exception $e) {
                 echo ". Exception: " . $e->getMessage();
                 Yii::error( "Exception in " . basename(__FILE__) . ". Exception: " . $e->getMessage(),$category );
            }
        }
    }


}